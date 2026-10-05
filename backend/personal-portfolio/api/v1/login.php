<?php
 
declare(strict_types=1);

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    header("Allow: POST");

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => "Method not allowed. Allowed: POST",
    ]);

    exit;
}


$initialize = require_once dirname(__DIR__, 2) . '/config/initialize.php';

if (!$initialize) {

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => "Initialization Error Please Contact API developer",
    ]);

    exit;
}

require_once $initialize['helper'] . '/helper.php';
require_once $initialize['model'] . 'User.php';




