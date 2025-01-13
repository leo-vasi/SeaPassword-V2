<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../entities/User.php';

class UserDAO {
    private $connection;

    public function __construct(){
        $connectionFactory = new ConnectionFactory();
        $this->connection = $connectionFactory->getConnection();
    }

    public function getAllUsers(): array {
        $query = 'SELECT * FROM users';
        $result = $this->connection->query($query);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new User(
                $row['user_id'],
                $row['user_name'],
                $row['user_email'],
                $row['user_password']
            );
        }
        return $users;
    }
}

?>
