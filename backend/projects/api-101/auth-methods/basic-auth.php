<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Authorization, Content-Type');
header('Access-Control-Allow-Origin: *');

// Browsers check permission before sending a cross-origin Authorization header.
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

const TABLE = '_users';

require_once dirname(__DIR__) . '/config.php';

// PHP usually exposes Basic Auth credentials in these server variables.
$username = $_SERVER['PHP_AUTH_USER'] ?? null;
$password = $_SERVER['PHP_AUTH_PW'] ?? null;

// Some server configurations expose the raw Authorization header instead.
if (($username === null || $password === null) && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    if (preg_match('/^Basic\s+(.+)$/i', $_SERVER['HTTP_AUTHORIZATION'], $matches) === 1) {
        $decodedCredentials = base64_decode($matches[1], true);
        if ($decodedCredentials !== false && str_contains($decodedCredentials, ':')) {
            [$username, $password] = explode(':', $decodedCredentials, 2);
        }
    }
}

if (!is_string($username) || $username === '' || !is_string($password) || $password === '') {
    header('WWW-Authenticate: Basic realm="API-101", charset="UTF-8"');
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Valid Basic Auth credentials are required.']);
    exit;
}

try {
    $connection = (new Database())->connect();
    $query = 'SELECT username, password FROM ' . TABLE . ' WHERE username = ? LIMIT 1';
    $statement = $connection->prepare($query);
    $statement->execute([$username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!is_array($user) || !password_verify($password, (string) $user['password'])) {
        header('WWW-Authenticate: Basic realm="API-101", charset="UTF-8"');
        http_response_code(401);
        echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        exit;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Authentication successful.',
        'user' => ['username' => $user['username']],
    ]);
} catch (\Throwable $th) {
    error_log('Basic Auth failed: ' . $th->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Authentication could not be completed.']);
}
