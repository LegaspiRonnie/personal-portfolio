<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');

// get patch initialization file
$path = require_once '../../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/Item.php';
require_once $path['helper'] . '/helper.php';

try {
    $db = new Database();
    $conn = $db->connect();

    $item = new Item($conn);

    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? '');

    if ($method !== 'GET') {
        sendJson(405, [
            'message' => 'Method Not Allowed.',
        ]);
    }

    $rawQuery = $_GET['q'] ?? null;

    if (is_array($rawQuery)) {
        sendJson(400, [
            'message' => 'Search query must be a string.',
        ]);
    }

    $query = trim((string) $rawQuery);

    if ($query === '') {
        sendJson(400, [
            'message' => 'Search query is required.',
        ]);
    }

    if (strlen($query) > 400) {
        sendJson(400, [
            'message' => 'Search query must not exceed 400 bytes.',
        ]);
    }

    $result = $item->search($query);

    sendJson(200, [
        'data' => $result,
        'count' => count($result),
    ]);



} catch (\Throwable $th) {
    sendJson(500, [
        'message' => 'Internal Server Error.',
    ]);
}
