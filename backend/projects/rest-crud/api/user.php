<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// get patch initialization file
$path = require_once '../config/initialize.php';

require_once $path['db'] . '/Database.php';
require_once $path['model'] . '/User.php';
require_once $path['helper'] . '/helper.php';



try {
    $db = new Database();
    $conn = $db->connect();

    $user = new User($conn);

    $method = $_SERVER['REQUEST_METHOD'];

    $rawId = $_GET['id'] ?? null;
    switch (strtoupper($method)) {
        case 'GET':
            // Validate the ID
            if ($rawId !== null) {
                $id = validateId($rawId);

                // Fetch the user data
                $data = $user->show($id);

                // If no data is found, send a 404 Not Found response
                if ($data === []) {
                    sendJson(404, [
                        'status' => false,
                        'message' => 'User not found.',
                    ]);
                }
                // Send the user data as a JSON response
                sendJson(200, [
                    'status' => true,
                    'data' => $data,
                ]);

            } else {
                // If no ID is provided set it to null
                $id = null;

                // Fetch all users if no ID is provided
                $data = $user->index();

                // If no users are found, send a 404 Not Found response
                if ($data === []) {
                    sendJson(404, [
                        'status' => false,
                        'message' => 'No users found.',
                    ]);
                }

                sendJson(200, [
                    'status' => true,
                    'data' => $data,
                ]);

            }

            break;
        case 'POST':
            // get the data by body
            $input = json_decode(file_get_contents('php://input'), true);

            // take input and store in local variables
            $username = trim((string) ($input['username'] ?? ''));
            $email    = trim((string) ($input['email'] ?? ''));
            $password = (string) ($input['password'] ?? '');


            // validate username
            if ($username === '') {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Username is required',
                ]);
            }

            // validate email
            if ($email === '') {
                sendJson(400, [
                    'status' => false,
                    'message' => 'email is required',
                ]);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Invalid email format',
                ]);
            }

            // validate password
            if ($password === '') {
                sendJson(400, [
                    'status' => false,
                    'message' => 'password is required',
                ]);
            }

            // check if username already exists
            $isUsernameExist = $user->isUsernameExist($username);

            if ($isUsernameExist) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Username already exists',
                ]);
            }

            // check if email already exists
            $isEmailExist = $user->isEmailExist($email);

            if ($isEmailExist) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Email already exists',
                ]);
            }


            // call the create method from the User model
            $result =  $user->create($username, $email, $password);

            // check the result and send appropriate response
            if ($result === false) {
                sendJson(500, [
                    'status' => false,
                    'message' => 'Failed to create user',
                ]);
            }


            if ($result === true) {
                sendJson(201, [
                    'status' => true,
                    'message' => 'User created successfully',
                ]);
            }

            break;
        case 'PUT':

            $requestBody = file_get_contents('php://input');
            $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
            $input = null;

            if (str_contains($contentType, 'application/json')) {
                $input = json_decode($requestBody, true);
            } elseif (str_contains($contentType, 'application/x-www-form-urlencoded')) {
                parse_str($requestBody, $input);
            }

            if (!is_array($input)) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Request body must be valid JSON or URL-encoded data.',
                    'error' => json_last_error_msg(),
                ]);
            }

            // take input and store in local variables
            $username = trim((string) ($input['username'] ?? ''));
            $email    = trim((string) ($input['email'] ?? ''));
            $password = (string) ($input['password'] ?? '');

            if ($username === '') {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Username is required.',
                ]);
            }

            if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'A valid email is required.',
                ]);
            }

            if ($password === '') {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Password is required.',
                ]);
            }

            $id = validateId($rawId);

            if ($user->show($id) === []) {
                sendJson(404, [
                    'status' => false,
                    'message' => 'User not found.',
                ]);
            }

            // check if username already exists
            $isUsernameExist = $user->isUsernameExist($username, $id);

            if ($isUsernameExist) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Username already exists',
                ]);
            }

            // check if email already exists
            $isEmailExist = $user->isEmailExist($email, $id);

            if ($isEmailExist) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Email already exists',
                ]);
            }

            // call the update method from the User model
            $result = $user->update($id, $input);

            // check the result and send appropriate response
            if ($result === false) {
                sendJson(500, [
                    'status' => false,
                    'message' => 'Failed to update user',
                ]);
            }

            // check if the update was successful and send appropriate response
            if ($result === true) {
                sendJson(200, [
                    'status' => true,
                    'message' => 'User updated successfully',
                ]);
            }


            break;
        case 'DELETE':
            $id = validateId($rawId);

            $isUserExist = $user->show($id);

            if ($isUserExist === []) {
                sendJson(404, [
                    'status' => false,
                    'message' => 'User not found.',
                ]);
            }

            $result = $user->delete($id);

            if ($result === false) {
                sendJson(500, [
                    'status' => false,
                    'message' => 'Failed to delete user',
                ]);
            }

            if ($result === true) {
                sendJson(200, [
                    'status' => true,
                    'message' => 'User deleted successfully',
                ]);
            }


            break;
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
            break;
    }

} catch (\Throwable $th) {
    sendJson(500, [
        'status' => false,
        'message' => 'Internal Server Error',
        'error' => $th->getMessage(),
    ]);
}
