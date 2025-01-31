<?php
require_once __DIR__ . '/../dao/StorageDAO.php';

class StorageController {
    private StorageDAO $storageDAO;
    public function __construct() {
        $this-> storageDAO = new StorageDAO();
    }

    public function getAllStorages(): array {
        return $this-> storageDAO-> getAllStorages();
    }

    public function getStorageById(int $id): ?Storage {
        return $this->storageDAO->getStorageById($id);
    }

    public function createStorage(Storage $storage): bool {
        return $this->storageDAO->createStorage($storage);
    }
}


?>