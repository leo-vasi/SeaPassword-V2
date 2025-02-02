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

    public function createStorage(Storage $storage): bool {
        $query = 'INSERT INTO storages (user_id, storage_description, storage_email, storage_password) VALUES (?, ?, ?, ?)';
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die("Error preparing query: " . $this->connection->error);
        } else {
            $userId = $storage->getUser()->getId();
            $storageDescription = $storage->getDescriptionStrg();
            $storageEmail = $storage->getEmailStrg();
            $storagePassword = $storage->getPasswordStrg();
            $hashedPassword = password_hash($storagePassword, PASSWORD_DEFAULT);
            $stmt->bind_param("isss", $userId, $storageDescription, $storageEmail, $hashedPassword);
            $success = $stmt->execute();
            $stmt->close();
            return $success;
        }
    }

    public function updateStorage(Storage $storage): bool {
        $query = 'UPDATE storages SET storage_description = ?, storage_email = ?, storage_password = ? WHERE storage_id = ?';
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die("Error preparing query: " . $this->connection->error);
        } else {
            $storageDescription = $storage->getDescriptionStrg();
            $storageEmail = $storage->getEmailStrg();
            $hashedPassword = password_hash($storage->getPasswordStrg(), PASSWORD_DEFAULT);
            $storageId = $storage->getId();
            $stmt->bind_param("sssi", $storageDescription, $storageEmail, $hashedPassword, $storageId);
            $success = $stmt->execute();
            $stmt->close();
            return $success;
        }
    }



}

?>
