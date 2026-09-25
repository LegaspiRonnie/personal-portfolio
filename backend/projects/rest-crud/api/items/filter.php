<?php

declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
header('Access-Control-Allow-Methods: GET');

$path = require_once '../../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/Item.php';
require_once $path['helper'] . '/helper.php';


$conditions = [];
$parameters = [];

$category = $_GET['category'] ?? null;
$rarity = $_GET['rarity'] ?? null;

try {
    $db = new Database();
    $conn = $db->connect();

    $item = new Item($conn);

    if ($category != null) {
        $conditions[] = 'category = ?';
        $parameters[] = $category;
    }
    if ($rarity != null) {
        $conditions[] = 'rarity = ?';
        $parameters[] = $rarity;
    }

    $result = $item->filter();


} catch (\Throwable $th) {
    //throw $th;
}