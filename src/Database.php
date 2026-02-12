<?php

namespace App;

use PDO;
use PDOException;

class Database
{
    private ?PDO $conn = null;

    /**
     * Get the database connection
     */
    public function connect(): PDO
    {
        if ($this->conn === null) {
            // Read from environment variables
            $host = $_ENV['DB_HOST'];
            $db   = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];

            try {
                $dsn = "mysql:host=" . $host . ";dbname=" . $db . ";charset=utf8mb4";

                $this->conn = new PDO($dsn, $user, $pass);

                // Set error mode to exception (crashes loudly if something breaks, which is good for debugging)
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetch results as associative arrays by default (['name' => 'John'] instead of [0 => 'John'])
                $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // In production, log this to a file instead of echoing
                die("Database Connection Error: " . $e->getMessage());
            }
        }

        return $this->conn;
    }
}
