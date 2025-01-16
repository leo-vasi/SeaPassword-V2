<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserController {
    private UserDAO $userDAO;
    public function __construct() {
        $this-> userDAO = new UserDAO();
    }

    public function getAllUsers(): array {
        return $this-> userDAO-> getAllUsers();
    }

    public function getUserById(int $id): ?User {
        return $this->userDAO-> getUserById($id);
    }

}


?>