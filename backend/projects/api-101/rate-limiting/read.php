<?php

declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET");

require_once __DIR__ . '/helper.php';


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    response(false, 'Method not allowed.', null, 405);
}

if (isRateLimited($_SERVER['REMOTE_ADDR'] ?? 'unknown', 60, 60)) {
    response(false, 'Too many requests. Please try again later.', null, 429);
}

$rawId = $_GET['id'] ?? null; 

if ($rawId !== null) {
    header('Location: read-one.php');
}

require_once __DIR__ . '/db.php';

const TABLE = "rest_items";

try {
    $sql = "SELECT * FROM " . TABLE;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $items = $stmt->fetchAll();

    if ($items === []) {
        response(true, "No Items found", null, 200);
    }

    response(true, null, $items, 200);

} catch(\Throwable $th) {
    response(false, $th->getMessage(), null, 500);
}
