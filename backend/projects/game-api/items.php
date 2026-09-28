<?php
declare(strict_types=1);
header("Content-Type: application/json; charst=utf8mb4");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    http_response_code(204);
    exit;
}

require_once './config.php';