<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../model/Storage.php';
require_once __DIR__ . '/../dao/UserDAO.php';

class StorageDAO {
    private $connection;
    private $userDAO;

    public function __construct(){
        $connectionFactory = new ConnectionFactory();
        $this->connection = $connectionFactory->getConnection();
        $this->userDAO = new UserDAO();

    }


    public function getStorageById(int $id): ?Storage {
        $query = "SELECT * FROM storages WHERE storage_id = ?";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta: " . $this->connection->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new Storage(
                $row['storage_id'],
                $this->userDAO->getUserById($row['user_id']),
                $row['storage_description'],
                $row['storage_email'],
                $row['storage_password']
            );
        }
        return null;
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
