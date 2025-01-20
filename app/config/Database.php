<?php

namespace App\config;

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;
use Exception;

class Database
{
    private static ?PDO $conn = null;

    public static function connection(): PDO
    {
        if (self::$conn === null) {
            // Load environment variables
            $dotenv = Dotenv::createImmutable(__DIR__);
            try {
                $dotenv->load();
            } catch (Exception $e) {
                die("Error loading .env file: " . $e->getMessage());
            }

            // Establish PDO connection
            try {
                self::$conn = new PDO(
                    "mysql:host=" . $_ENV["LOCALHOST"] . ";dbname=" . $_ENV["DATABASE"],
                    $_ENV["USER"],
                    $_ENV["USER_PASSWORD"],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Default fetch mode
                    ]
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$conn;
    }

    public static function disconnect(): void
    {
        self::$conn = null; // Explicitly close the connection
    }
}
