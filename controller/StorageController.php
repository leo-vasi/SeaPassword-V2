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
}


?>