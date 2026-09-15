<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
require_once dirname(__DIR__, 2) . '/config/Database.php';
require_once dirname(__DIR__, 2) . '/helper/helper.php';
require_once dirname(__DIR__, 1) . '/models/Project.php';

try {
    $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? '');

    $db = new Database();
    $conn = $db->connect();
    
    $project = new Project($conn);

    switch ($method) {
        case 'GET':
            $rawId = $_GET['id'] ?? null;

            if (is_array($rawId)) {
                sendJson(400, [
                    'status' => false,
                    'message' => 'Invalid ID. Please enter a valid number',
                ]);
            }

            if ($rawId === null) {
                $id = null;
            } else {
                $id = filter_var($rawId, FILTER_VALIDATE_INT);

                if ($id === false) {
                    sendJson(400, [
                        'status' => false,
                        'message' => 'Invalid ID. Please enter a valid number',
                    ]);
                }

                if ($id <= 0) {
                    sendJson(400, [
                        'status' => false,
                        'message' => 'ID must be a positive number',
                    ]);
                }
            }

            sendJson(200, [
                'status' => true,
                'data' => $project->index($id),
            ]);

            break;

        default:
            header('Allow: GET');
            sendJson(405, [
                'status' => false,
                'message' => 'Method not allowed',
            ]);
    }

} catch (\Throwable $th) {
    error_log($th->getMessage());
    sendJson(500, [
        'status' => false,
        'message' => 'Internal server error',
    ]);
}