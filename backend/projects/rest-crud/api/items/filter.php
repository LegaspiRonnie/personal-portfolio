<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');

$path = require_once '../../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/Item.php';
require_once $path['helper'] . '/helper.php';

try {
    if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'GET') {
        header('Allow: GET');
        sendJson(405, ['message' => 'Method Not Allowed.']);
    }

    $filters = [];
    foreach (['category', 'rarity', 'q'] as $key) {
        if (!isset($_GET[$key])) {
            continue;
        }
        if (!is_string($_GET[$key])) {
            sendJson(400, ['message' => "{$key} must be a string."]);
        }

        $value = trim($_GET[$key]);
        if ($value !== '') {
            if (strlen($value) > 100) {
                sendJson(400, ['message' => "{$key} must be 100 characters or fewer."]);
            }
            $filters[$key] = $value;
        }
    }

    foreach (['min_price', 'max_price'] as $key) {
        if (!isset($_GET[$key])) {
            continue;
        }
        if (!is_string($_GET[$key]) || !is_numeric($_GET[$key]) || (float) $_GET[$key] < 0) {
            sendJson(400, ['message' => "{$key} must be a non-negative number."]);
        }
        $filters[$key] = (float) $_GET[$key];
    }

    if (isset($filters['min_price'], $filters['max_price']) && $filters['min_price'] > $filters['max_price']) {
        sendJson(400, ['message' => 'min_price cannot be greater than max_price.']);
    }

    $sortBy = $_GET['sort_by'] ?? 'name';
    $orderBy = $_GET['order'] ?? 'asc';
    if (!is_string($sortBy) || !is_string($orderBy)) {
        sendJson(400, ['message' => 'sort_by and order must be strings.']);
    }
    $filters['sort_by'] = strtolower(trim($sortBy));
    $filters['order_by'] = strtolower(trim($orderBy));

    $limit = $_GET['limit'] ?? '20';
    $offset = $_GET['offset'] ?? '0';
    if (!is_string($limit) || filter_var($limit, FILTER_VALIDATE_INT) === false || (int) $limit < 1 || (int) $limit > 100) {
        sendJson(400, ['message' => 'limit must be an integer from 1 to 100.']);
    }
    if (!is_string($offset) || filter_var($offset, FILTER_VALIDATE_INT) === false || (int) $offset < 0) {
        sendJson(400, ['message' => 'offset must be a non-negative integer.']);
    }
    $filters['limit'] = (int) $limit;
    $filters['offset'] = (int) $offset;

    $db = new Database();
    $item = new Item($db->connect());
    $result = $item->filter($filters);

    sendJson(200, [
        'data' => $result,
        'count' => count($result),
        'filters' => $filters,
    ]);
} catch (InvalidArgumentException $exception) {
    sendJson(400, ['message' => $exception->getMessage()]);
} catch (Throwable $exception) {
    sendJson(500, ['message' => 'Internal Server Error.']);
}
