<?php
require_once __DIR__ . '/../dao/StorageDAO.php';
require_once __DIR__ . '/../exceptions/InvalidDataException.php';

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
        try {
            return $this->storageDAO->createStorage($storage);
        } catch (InvalidDataException $e) {
            echo "Erro ao criar armazenamento: " . $e->getMessage();
            return false;
        }
    }

    public function updateStorage(int $id, User $user, string $descriptionStrg, string $emailStrg, string $passwordStrg): bool {
        try {
            $storage = new Storage($id, $user, $descriptionStrg, $emailStrg, $passwordStrg);
            return $this->storageDAO->updateStorage($storage);
        } catch (InvalidDataException $e) {
            echo "Erro ao atualizar armazenamento: " . $e->getMessage();
            return false;
        }
    }

    public function deleteStorage(int $id): bool {
        return $this->storageDAO->deleteStorage($id);
    }

}


?>