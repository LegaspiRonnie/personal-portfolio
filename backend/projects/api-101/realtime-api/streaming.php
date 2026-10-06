<?php

// Send database rows as newline-delimited JSON while the response is open.
header('Content-Type: application/x-ndjson; charset=utf-8');
header('Cache-Control: no-cache');
header('X-Accel-Buffering: no');

require_once dirname(__DIR__) . '/config.php';

const TABLE = 'rest_items';

// Send five rows by default. Use ?limit=10 to request more, up to 20.
$requestedLimit = filter_var($_GET['limit'] ?? '5', FILTER_VALIDATE_INT);
if ($requestedLimit === false || $requestedLimit < 1) {
    http_response_code(400);
    echo json_encode(['error' => 'The limit must be a positive integer.']) . "\n";
    exit;
}
$rowLimit = min($requestedLimit, 20);

// Let the response stay open while rows are being sent.
set_time_limit(0);

try {
    $pdo = (new Database())->connect();
    $query = $pdo->prepare('SELECT * FROM ' . TABLE . ' ORDER BY id ASC LIMIT :row_limit');
    $query->bindValue(':row_limit', $rowLimit, PDO::PARAM_INT);
    $query->execute();

    $rowCount = 0;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        // Stop sending rows if the client closes the connection.
        if (connection_aborted()) {
            break;
        }

        // Each JSON object is one line, making the response easy to inspect in Postman.
        echo json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR) . "\n";
        $rowCount++;

        // Flush each row so the client receives it before the query is fully consumed.
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();

        // A short pause makes the streaming behavior visible when testing.
        if ($rowCount < $rowLimit) {
            sleep(1);
        }
    }

    if ($rowCount === 0) {
        echo json_encode(['message' => 'No rows found.']) . "\n";
        flush();
    }
} catch (Throwable $exception) {
    // Keep connection details out of the response while logging them on the server.
    error_log('Database row stream failed: ' . $exception->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Could not stream database rows.']) . "\n";
    flush();
}
