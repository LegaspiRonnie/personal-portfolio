<?php


function response(
    bool $status,
    ?string $message = null,
    mixed $data = null,
    int $code = 200,
): never {
    http_response_code($code);

    $payload = ['status' => $status];

    if ($message !== null) {
        $payload['message'] = $message;
    }

    if ($data !== null) {
        $payload['data'] = $data;
    }

    echo json_encode($payload, JSON_INVALID_UTF8_SUBSTITUTE);

    exit;
}

function isRateLimited(string $key, int $limit, int $windowSeconds): bool
{
    $now = time();
    $windowStart = intdiv($now, $windowSeconds) * $windowSeconds;
    $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'api-101-rate-limit-' . hash('sha256', $key) . '.json';
    $file = fopen($path, 'c+');

    if ($file === false || !flock($file, LOCK_EX)) {
        if ($file !== false) {
            fclose($file);
        }

        return true;
    }

    rewind($file);
    $state = json_decode(stream_get_contents($file), true);
    $count = is_array($state) && ($state['window'] ?? null) === $windowStart
        ? (int) ($state['count'] ?? 0) + 1
        : 1;

    rewind($file);
    ftruncate($file, 0);
    $written = fwrite($file, json_encode(['window' => $windowStart, 'count' => $count]));
    fflush($file);
    flock($file, LOCK_UN);
    fclose($file);

    if ($written === false) {
        return true;
    }

    $remaining = max(0, $limit - $count);
    header('X-RateLimit-Limit: ' . $limit);
    header('X-RateLimit-Remaining: ' . $remaining);
    header('X-RateLimit-Reset: ' . ($windowStart + $windowSeconds));

    if ($count > $limit) {
        header('Retry-After: ' . max(1, $windowStart + $windowSeconds - $now));

        return true;
    }

    return false;
}
