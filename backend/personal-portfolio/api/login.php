<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once dirname(__DIR__, 2) . '/config/Database.php';
require_once dirname(__DIR__, 1) . '/models/User.php';
require_once dirname(__DIR__, 2) . '/helper/helper.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        sendJson(405, [
            'status' => false,
            'message' => 'Method not allowed',
        ]);
    }

    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    $requestData = [];

    if (stripos($contentType, 'application/json') !== false) {
        $rawBody = file_get_contents('php://input');
        $requestData = json_decode($rawBody, true) ?? [];
    } else {
        $requestData = $_POST;
    }

    $email = $requestData['email'] ?? null;
    $password = $requestData['password'] ?? null;

    if (!is_string($email) || trim($email) === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        sendJson(400, [
            'status' => false,
            'message' => 'Valid email is required',
        ]);
    }

    if (!is_string($password) || trim($password) === '') {
        sendJson(400, [
            'status' => false,
            'message' => 'Password is required',
        ]);
    }

    $database = new Database();
    $connection = $database->connect();
    $userModel = new User($connection);

    $result = $userModel->login($email, $password);

    if (!$result['status']) {
        sendJson(401, $result);
    }

    sendJson(200, $result);
} catch (\Throwable $th) {
    error_log($th->getMessage());

    sendJson(500, [
        'status' => false,
        'message' => 'Internal server error',
    ]);
}