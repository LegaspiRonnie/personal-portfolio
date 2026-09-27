<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');

$path = require_once '../../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/Item.php';
require_once $path['helper'] . '/helper.php';

try {
    $db = new Database();
    $conn = $db->connect();
    $item = new Item($conn);

    $rawOffset = $_GET['offset'] ?? '0';
    $rawLimit = $_GET['limit'] ?? '10';
    $max_limit = 50;

    if (!is_string($rawOffset) || filter_var($rawOffset, FILTER_VALIDATE_INT) === false) {
        sendJson(400, [
            'status' => false,
            'message' => 'Offset must be an integer.',
        ]);
    }
    $offset = (int) $rawOffset;

    if ($offset < 0) {
        sendJson(400, [
            'status' => false,
            'message' => 'Offset must be zero or greater.',
        ]);
    }

    if (!is_string($rawLimit) || filter_var($rawLimit, FILTER_VALIDATE_INT) === false) {
        sendJson(400, [
            'status' => false,
            'message' => 'Limit must be an integer.',
        ]);
    }
    $limit = (int) $rawLimit;

    if ($limit > $max_limit) {
        sendJson(400, [
            'status' => false,
            'message' => "Limit must not be greater than {$max_limit}.",
        ]);
    }

    if ($limit < 1) {
        sendJson(400, [
            'status' => false,
            'message' => 'Limit must be at least 1.',
        ]);
    }

    $result = $item->index($offset, $limit);
    $items = $result['data'];
    $total = $result['total'];

    sendJson(200, [
        'status' => true,
        'data' => $items,
        'pagination' => [
            'limit' => $limit,
            'offset' => $offset,
            'total' => $total,
            'has_more' => ($offset + count($items)) < $total,
        ],
    ]);


} catch (\Throwable $th) {
    sendJson(500, [
        'status' => false,
        'message' => $th->getMessage(),
    ]);
}
