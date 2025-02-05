<?php

require_once 'ConnectionFactory.php';

class ConnectionTester {
    public static function testConnection() {
        try {
            $connectionFactory = new ConnectionFactory();
            $conn = $connectionFactory->getConnection();
            echo "Connection to the database was successful!";
        } catch (Exception $e) {
            echo "Failed to connect to the database: " . $e->getMessage();
        }
    }
}

ConnectionTester::testConnection();

?>
