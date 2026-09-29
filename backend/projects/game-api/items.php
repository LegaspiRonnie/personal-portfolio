<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/config.php';

const ITEM_TABLE = 'rest_items';

$method = $_SERVER['REQUEST_METHOD'];
$rawId = $_GET['id'] ?? null;
$id = null;

if ($rawId !== null) {
    $validatedId = filter_var($rawId, FILTER_VALIDATE_INT);

    if ($validatedId === false || $validatedId <= 0) {
        response('error', null, 'ID must be a positive integer.', 400);
    }

    $id = $validatedId;
}

function response(
    string $status,
    mixed $data = null,
    ?string $message = null,
    int $code = 200
): never {
    $payload = ['status' => $status];

    if ($message !== null) {
        $payload['message'] = $message;
    }

    if ($data !== null) {
        $payload['data'] = $data;
    }

    http_response_code($code);
    echo json_encode($payload, JSON_INVALID_UTF8_SUBSTITUTE);
    exit;
}

function requireId(?int $id): int
{
    if ($id === null) {
        response('error', null, 'ID is required.', 400);
    }

    return $id;
}

function findItem(PDO $pdo, int $id): ?array
{
    $query = 'SELECT id, name, category, rarity, price
              FROM ' . ITEM_TABLE . '
              WHERE id = ?
              LIMIT 1';
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
    $item = $statement->fetch();

    if ($item === false) {
        return null;
    }

    $item['price'] = (float) $item['price'];

    return $item;
}

function readItemInput(): array
{
    $body = json_decode(file_get_contents('php://input'), true);

    if (!is_array($body)) {
        response('error', null, 'Request body must be valid JSON.', 400);
    }

    $name = trim($body['name'] ?? '');
    $category = trim($body['category'] ?? '');
    $rarity = trim($body['rarity'] ?? '');
    $price = $body['price'] ?? null;

    if ($name === '' || $category === '' || $rarity === '') {
        response('error', null, 'Name, category, and rarity are required.', 400);
    }

    if (!is_numeric($price) || (float) $price < 0) {
        response('error', null, 'Price must be a non-negative number.', 400);
    }

    return [
        'name' => $name,
        'category' => $category,
        'rarity' => $rarity,
        'price' => (float) $price,
    ];
}

if ($method === 'GET') {
    if ($id !== null) {
        $item = findItem($pdo, $id);

        if ($item === null) {
            response('error', null, 'Item not found.', 404);
        }

        response('success', $item);
    }

    $query = 'SELECT id, name, category, rarity, price FROM ' . ITEM_TABLE;
    $statement = $pdo->query($query);
    $items = $statement->fetchAll();

    foreach ($items as &$item) {
        $item['price'] = (float) $item['price'];
    }
    unset($item);

    response('success', $items);
}

if ($method === 'POST') {
    $item = readItemInput();
    $query = 'INSERT INTO ' . ITEM_TABLE . ' (name, category, rarity, price)
              VALUES (?, ?, ?, ?)';
    $statement = $pdo->prepare($query);
    $statement->execute([
        $item['name'],
        $item['category'],
        $item['rarity'],
        $item['price'],
    ]);

    $createdItem = findItem($pdo, (int) $pdo->lastInsertId());
    response('success', $createdItem, 'Item created successfully.', 201);
}

if ($method === 'PUT') {
    $id = requireId($id);

    if (findItem($pdo, $id) === null) {
        response('error', null, 'Item not found.', 404);
    }

    $item = readItemInput();
    $query = 'UPDATE ' . ITEM_TABLE . '
              SET name = ?, category = ?, rarity = ?, price = ?
              WHERE id = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([
        $item['name'],
        $item['category'],
        $item['rarity'],
        $item['price'],
        $id,
    ]);

    response('success', findItem($pdo, $id), 'Item updated successfully.');
}

if ($method === 'DELETE') {
    $id = requireId($id);

    if (findItem($pdo, $id) === null) {
        response('error', null, 'Item not found.', 404);
    }

    $query = 'DELETE FROM ' . ITEM_TABLE . ' WHERE id = ?';
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);

    response('success', null, 'Item deleted successfully.');
}

header('Allow: GET, POST, PUT, DELETE, OPTIONS');
response('error', null, 'Method not allowed.', 405);
