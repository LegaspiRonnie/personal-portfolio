<?php
//test
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

// Load the shared backend database bootstrap used by all project APIs.
require_once dirname(__DIR__, 3) . '/config/Database.php';

// Keep the public weather-service URLs in this endpoint because they are not database credentials.
$geocodingUrl = 'https://geocoding-api.open-meteo.com/v1/search';
$forecastUrl = 'https://api.open-meteo.com/v1/forecast';

function sendJson(int $statusCode, array $payload): void
{
    http_response_code($statusCode);
    echo json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}

$city = trim((string)($_GET['city'] ?? ''));

if ($city === '') {
    sendJson(400, [
        'success' => false,
        'message' => 'City is required.'
    ]);
}

$geocodingQuery = http_build_query([
    'name' => $city,
    'count' => 1,
    'language' => 'en',
    'format' => 'json'
]);

$geocodingResponse = file_get_contents($geocodingUrl . '?' . $geocodingQuery);
if ($geocodingResponse === false) {
    sendJson(502, [
        'success' => false,
        'message' => 'Unable to connect to weather service.'
    ]);
}

$data = json_decode($geocodingResponse, true);
if (!is_array($data) || empty($data['results'][0])) {
    sendJson(404, [
        'success' => false,
        'message' => 'City not found.'
    ]);
}

$location = $data['results'][0];
$latitude = $location['latitude'] ?? null;
$longitude = $location['longitude'] ?? null;

if (!is_numeric($latitude) || !is_numeric($longitude)) {
    sendJson(502, [
        'success' => false,
        'message' => 'Location coordinates are missing.'
    ]);
}

$forecastQuery = http_build_query([
    'latitude' => (float) $latitude,
    'longitude' => (float) $longitude,
    'current' => 'temperature_2m,relative_humidity_2m,weather_code,wind_speed_10m',
    'timezone' => 'auto'
]);

$forecastResponse = file_get_contents($forecastUrl . '?' . $forecastQuery);
if ($forecastResponse === false) {
    sendJson(502, [
        'success' => false,
        'message' => 'Unable to fetch weather forecast.'
    ]);
}

$weather = json_decode($forecastResponse, true);
if (!is_array($weather) || !isset($weather['current'])) {
    sendJson(502, [
        'success' => false,
        'message' => 'Invalid weather forecast response.'
    ]);
}

$current = $weather['current'];

sendJson(200, [
    'success' => true,
    'data' => [
        'city' => $location['name'] ?? $city,
        'country' => $location['country'] ?? $location['country_code'] ?? null,
        'latitude' => (float) $latitude,
        'longitude' => (float) $longitude,
    ],
    'weather' => [
        'temperature' => $current['temperature_2m'] ?? null,
        'humidity' => $current['relative_humidity_2m'] ?? null,
        'wind_speed' => $current['wind_speed_10m'] ?? null,
        'weather_code' => $current['weather_code'] ?? null,
    ]
]);