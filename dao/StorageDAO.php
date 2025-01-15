<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../model/Storage.php';
require_once __DIR__ . '/../dao/UserDAO.php';

class StorageDAO {
    private $connection;

    public function __construct(){
        $connectionFactory = new ConnectionFactory();
        $this->connection = $connectionFactory->getConnection();
    }

    public function getAllStorages(): array {
        $query = 'SELECT * FROM storages';
        $result = $this->connection->query($query);
        $userDAO = new UserDAO();
        $storages = [];
        while ($row = $result->fetch_assoc()) {
            $user = $userDAO->getUserById($row['user_id']);
            $storages[] = new Storage(
                $row['storage_id'],
                $user,
                $row['storage_description'],
                $row['storage_email'],
                $row['storage_password']
            );
        }
        return $storages;
    }
}

?>
