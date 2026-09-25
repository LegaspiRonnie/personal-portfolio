<?php

declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
header('Access-Control-Allow-Methods: GET');

$path = require_once '../../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/Item.php';
require_once $path['helper'] . '/helper.php';


$allowed_columns = ['name', 'price', 'rarity'];
$allowed_order = ['asc', 'desc'];

try {
    $db = new Database();
    $conn = $db->connect();

    $item = new Item($conn);

    if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'GET') {
        header('Allow: GET');
        sendJson(405, ['message' => 'Method Not Allowed.']);
    }

    // Reject array input such as ?by[]=name instead of coercing it to a string.
    $rawSortBy = $_GET['by'] ?? null;
    $rawOrderBy = $_GET['order'] ?? 'desc';
    if (!is_string($rawSortBy) || !is_string($rawOrderBy)) {
        sendJson(400, ['message' => 'Sort and order parameters must be strings.']);
    }

    $sort_by = strtolower(trim($rawSortBy));

    // get order parameter value
    $order_by = strtolower(trim($rawOrderBy));

    // check if sort parameter is set, it is required
    if ($sort_by === '') {
        sendJson(400, [
            'message' => 'Sort parameter is required.',
        ]);
    }

    // check if order_by is in allowed_order
    if (!in_array($order_by, $allowed_order, true)) {
        sendJson(400, [
            'message' => 'Order value not valid',
            'valid orders' => $allowed_order,
        ]);
    }

    // check if $sort_by is in $allowed_columns
    if (!in_array($sort_by, $allowed_columns, true)) {
        sendJson(400, [
            'message' => 'Sort value not valid',
            'valid sorts' => $allowed_columns,
        ]);
    }

    // get items based on query
    $result = $item->sort($sort_by, $order_by);

    sendJson(200, [
        'data' => $result,
        'count' => count($result),
    ]);



} catch (\Throwable $th) {
    sendJson(500, [
        'message' => 'Internal Server Error.',
    ]);
}
