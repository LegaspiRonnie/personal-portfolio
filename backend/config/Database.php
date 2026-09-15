<?php

// Enable strict typing for the database configuration and connection class.
declare(strict_types=1);

// Load Composer so the dotenv package is available to this single configuration file.
require_once dirname(__DIR__) . '/vendor/autoload.php';

use Dotenv\Dotenv;

class Database
{
    private PDO $connection;

    public function __construct()
    {
        // Load environment variables from backend/.env without overwriting existing environment values.
        $projectRoot = dirname(__DIR__);
        if (is_file($projectRoot . '/.env')) {
            Dotenv::createImmutable($projectRoot)->safeLoad();
        }

        // Validate every database setting before attempting to connect.
        foreach (['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'] as $variable) {
            if (!array_key_exists($variable, $_ENV)) {
                throw new RuntimeException("Missing required environment variable: {$variable}");
            }
        }

        // Build a MySQL PDO DSN using the values loaded from $_ENV.
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_NAME']
        );

        // Create one shared PDO connection with exceptions and native prepared statements enabled.
        $this->connection = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    }

    public function connect(): PDO
    {
        // Return the initialized PDO connection to the API and model classes.
        return $this->connection;
    }
}
