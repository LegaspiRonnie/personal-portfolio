<?php

declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

require_once dirname(__DIR__, 2) . '/config/Database.php';

try {
    // Reuse the shared connection so this API uses DB_HOST and DB_PORT from backend/.env.
    $pdo = (new Database())->connect();
    // echo "connected";
} catch (Throwable $exception) {
    // Keep credentials and network details in the server log, not in the API response.
    error_log('Game API database connection failed: ' . $exception->getMessage());
    http_response_code(500);
    
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed.',
    ]);
    exit;
}
