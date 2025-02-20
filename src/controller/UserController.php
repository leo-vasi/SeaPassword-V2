<?php
require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../exceptions/UserNotFoundException.php';
require_once __DIR__ . '/../exceptions/InvalidDataException.php';


class UserController {
    private UserDAO $userDAO;
    public function __construct() {
        $this-> userDAO = new UserDAO();
    }

    public function getAllUsers(): array {
        return $this-> userDAO-> getAllUsers();
    }

    public function getUserById(int $id): ?User {
        try {
            return $this->userDAO->getUserById($id);
        } catch (UserNotFoundException $e) {
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }


    public function updateUser(int $id, string $name, string $email, string $password): bool {
        try {
            $user = $this->userDAO->getUserById($id);
            if (!$user) {
                throw new UserNotFoundException("Usuário com ID $id não encontrado para atualização.");
            }
            $user = new User($id, $name, $email, $password);
            return $this->userDAO->updateUser($user);
        } catch (UserNotFoundException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }


    public function createUser(User $user): bool {
        try {
            return $this->userDAO->createUser($user);
        } catch (InvalidDataException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Unexpected Error: " . $e->getMessage();
            return false;
        }
    }



    public function deleteUser(int $id): bool {
        try {
            $user = $this->userDAO->getUserById($id);
            if (!$user) {
                throw new UserNotFoundException("Usuário com ID $id não encontrado para exclusão.");
            }
            return $this->userDAO->deleteUser($id);
        } catch (UserNotFoundException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }


}


?>