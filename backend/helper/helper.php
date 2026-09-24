<?php

declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

function sendJson(int $statusCode, array $payload): void
{
    http_response_code($statusCode);
    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

function validateId(mixed $rawId): int
{
    if ($rawId === null || $rawId === '') {
        sendJson(400, [
            'status' => false,
            'message' => 'ID is required.',
        ]);
    }

    $id = filter_var($rawId, FILTER_VALIDATE_INT, [
        'options' => [
            'min_range' => 1,
        ],
    ]);

    if ($id === false) {
        sendJson(400, [
            'status' => false,
            'message' => 'ID must be a positive integer.',
        ]);
    }

    return $id;
}
