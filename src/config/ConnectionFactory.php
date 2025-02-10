<?php

require_once __DIR__ . '/../exceptions/DbConnectionException.php';
use exceptions\DbConnectionException;

class ConnectionFactory {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "seapassword_db";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->connection->connect_error) {
                throw new DbConnectionException("Error establishing database connection to database: " . $this->connection->connect_error);
            }
        } catch (DbConnectionException $e) {
            die("Unable to get connection " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
