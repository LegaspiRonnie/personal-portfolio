<?php

declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET");

require_once __DIR__ . '/helper.php';

// Allow up to 10 requests from the same client IP during each 60-second window.
function enforceRateLimit(int $maxRequests = 10, int $windowSeconds = 60): void
{
    $clientIp = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    // Hash the IP so it is not stored in plain text in the temporary rate-limit file.
    $filePath = sys_get_temp_dir() . DIRECTORY_SEPARATOR
        . 'api-101-rate-limit-' . hash('sha256', $clientIp) . '.txt';
    $file = fopen($filePath, 'c+');

    if ($file === false) {
        // Keep the endpoint available if the server cannot access temporary storage.
        error_log('Rate limiter could not open its temporary storage file.');
        return;
    }

    // Lock the file so simultaneous requests update the counter safely.
    if (!flock($file, LOCK_EX)) {
        fclose($file);
        error_log('Rate limiter could not lock its temporary storage file.');
        return;
    }

    $now = time();
    rewind($file);
    $storedState = trim((string) stream_get_contents($file));
    $parts = explode(':', $storedState, 2);
    $windowStartedAt = (int) $parts[0];
    $requestCount = isset($parts[1]) ? (int) $parts[1] : 0;

    // Start a fresh window when no valid window exists or the previous one expired.
    if ($windowStartedAt <= 0 || $now - $windowStartedAt >= $windowSeconds) {
        $windowStartedAt = $now;
        $requestCount = 0;
    }

    $requestCount++;
    rewind($file);
    ftruncate($file, 0);
    fwrite($file, $windowStartedAt . ':' . $requestCount);
    fflush($file);
    flock($file, LOCK_UN);
    fclose($file);

    if ($requestCount > $maxRequests) {
        // Tell clients when the current request window will reset.
        header('Retry-After: ' . max(1, $windowSeconds - ($now - $windowStartedAt)));
        rateLimitResponse(false, 'Too many requests. Please try again later.', null, 429);
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    rateLimitResponse(false, 'Method not allowed.', null, 405);
}

enforceRateLimit();

$rawId = $_GET['id'] ?? null;

if (!is_string($rawId) || $rawId === '') {
    rateLimitResponse(false, 'ID is required and must be a single value.', null, 400);
}

$id = filter_var($rawId, FILTER_VALIDATE_INT);

if ($id === false || $id <= 0) {
    rateLimitResponse(false, 'ID must be a positive integer.', null, 400);
}

$pdo = require __DIR__ . '/db.php';

const TABLE = "rest_items";

try {
    $sql = "SELECT * FROM " . TABLE . " WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $id,
    ]);
    $item = $stmt->fetch();

    if ($item === []) {
        rateLimitResponse(true, "Item not found", null, 200);
    }

    rateLimitResponse(true, null, $item, 200);

} catch (\Throwable $th) {
    rateLimitResponse(false, $th->getMessage(), null, 500);
}
