<?php
 
declare(strict_types=1);

session_start([
    'cookie_lifetime' => 604800, // 1 linggo sa segundo
    'cookie_secure'   => false,   // I-set sa true kung naka-HTTPS
    'cookie_httponly' => true,   // Proteksyon laban sa XSS
    'cookie_samesite' => 'Lax'   // Proteksyon laban sa CSRF
]);

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    header("Allow: POST");

    http_response_code(500);

    echo json_encode([
        'status' => 'error',
        'message' => "Method not allowed.",
        'allowed' => 'POST',
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

require_once $initialize['helper']   . '/helper.php';
require_once $initialize['model']    . '/User.php';
require_once $initialize['database'] . '/Database.php';

try {
    $db = new Database();
    $conn = $db->connect();

    $user = new User($conn);

    $body = json_decode(file_get_contents('php://input'), true);

    // 3. I-check kung may error talaga sa pag-decode ng JSON format
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendJson(400, [
            'status' => 'error',
            'message' => 'Invalid JSON format',
        ]);
    }

    if (empty($body)) {
        sendJson(400, [
            'status' => 'error',
            'message' => 'Request body cannot be empty',
        ]);
    }

    $email    = $body['email'] ?? null;
    $password = $body['password'] ?? null;

    if ($email === null || $password === null) {
        sendJson(400, [
            'status'  => 'error',
            'message' => 'Both parameters are required.',
            'parameters' => "Parameters: email, password",
        ]);
    }

    $findUser = $user->findUser($email);

    if ($findUser === false) {
        sendJson(400, [
            'status'  => 'error',
            'message' => 'User does not exist',
        ]);
    }

    $loginUser = $user->login($email, $password);

    if ($loginUser['status'] !== 'success') {
        sendJson($loginUser['code'], [
            'status' => $loginUser['status'],
            'message' => $loginUser['message'],
        ]);
    }

    $sessionSave = $loginUser['user'];

    $_SESSION['id']       = $sessionSave['id'];
    $_SESSION['username'] = $sessionSave['username'];
    $_SESSION['email']    = $sessionSave['email'];
    $_SESSION['log_in']   = true;

    // echo $_SESSION['id'];
    // echo $_SESSION['username'];
    // echo $_SESSION['email'];
    // echo $_SESSION['log_in'];

    sendJson($loginUser['code'], [
        'status'  => $loginUser['status'],
        'message' => $loginUser['message'],
    ]);

} catch (\Throwable $th) {
    sendJson(500, [
        'status' => 'error',
        'message' => 'Internal server error',
        'data'    => $th->getMessage(),
    ]);
}

