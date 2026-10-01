<?php 

function response(
    bool $status,
    ?string $message = null,
    mixed $data = null,
    int $code = 200,
): never {
    http_response_code($code);

    $payload = ['status' => $status];

    if ($message !== null ) {
        $payload['message'] = $message;
    }

    if ($data !== null ) {
        $payload['data'] = $data;
    }

    echo json_encode($payload, JSON_INVALID_UTF8_SUBSTITUTE); 

    exit;
}
