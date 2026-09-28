<?php

// declare strict type
declare(strict_types=1);

// content-type = application/json
header('Content-Type: application/json; charset=utf-8');
// method allowed POST
header('Access-Control-Allow-Methods: POST');

// initilize paths 
$path = require_once '../../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/Item.php';
require_once $path['helper'] . '/helper.php';

try {
    if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        header('Allow: POST');
        sendJson(405, [
            'status' => false,
            'message' => 'Method not allowed.',
        ]);
    }

    $contentType = strtolower(trim(explode(';', $_SERVER['CONTENT_TYPE'] ?? '')[0]));
    if ($contentType !== 'application/json') {
        sendJson(415, [
            'status' => false,
            'message' => 'Content-Type must be application/json.',
        ]);
    }

    $input = file_get_contents('php://input');
    if ($input === false) {
        sendJson(400, [
            'status' => false,
            'message' => 'Could not read the request body.',
        ]);
    }

    try {
        $decoded = json_decode($input, false, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $exception) {
        sendJson(400, [
            'status' => false,
            'message' => 'Request body must contain valid JSON.',
        ]);
    }

    if (!$decoded instanceof stdClass) {
        sendJson(400, [
            'status' => false,
            'message' => 'Request body must be a JSON object.',
        ]);
    }

    $data = get_object_vars($decoded);
    $allowedFields = ['name', 'category', 'rarity', 'price'];
    $unexpectedFields = array_diff(array_keys($data), $allowedFields);
    if ($unexpectedFields !== []) {
        sendJson(400, [
            'status' => false,
            'message' => 'Request contains unsupported fields.',
        ]);
    }

    // Validate before opening a database connection; the model repeats this check for direct callers.
    $data = Item::validateCreateData($data);

    $db = new Database();
    $conn = $db->connect();
    $item = new Item($conn);

    $result = $item->create($data);

    sendJson(201, [
        'status' => true,
        'message' => 'Item created successfully.',
        'data' => ['id' => $result],
    ]);
} catch (InvalidArgumentException $exception) {
    sendJson(400, [
        'status' => false,
        'message' => $exception->getMessage(),
    ]);
} catch (\Throwable $th) {
    error_log($th->getMessage());
    sendJson(500, [
        'status' => false,
        'message' => 'Internal Server Error.',
    ]);
}
