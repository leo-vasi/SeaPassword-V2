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

    public function updateUser(int $id, string $name, string $email, string $password): bool {
        $user = new User($id, $name, $email, $password);
        return $this->userDAO->updateUser($user);
    }

    public function createUser(User $user): bool {
        return $this->userDAO->createUser($user);
    }

}


?>