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
            $user = new User($id, $name, $email, $password);
            return $this->userDAO->updateUser($user);
        } catch (UserNotFoundException | InvalidDataException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }



    public function createUser(User $user): bool {
        try {
            return $this->userDAO->createUser($user);
        } catch (InvalidDataException | Exception $e) {
            echo "Erro ao criar usuário: " . $e->getMessage();
            return false;
        }
    }



    public function deleteUser(int $id): bool {
        try {
            return $this->userDAO->deleteUser($id);
        } catch (UserNotFoundException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function login() {
        session_start();
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data['email']) || !isset($data['password'])) {
            echo json_encode(["error" => "Campos obrigatórios não preenchidos"]);
            return;
        }
        $email = $data['email'];
        $password = $data['password'];
        $user = $this->userDAO->authenticateUser($email, $password);
        if ($user) {
            $_SESSION["id_usuario"] = $user["id"];
            $_SESSION["email"] = $user["email"];
            echo json_encode(["success" => "Login realizado com sucesso"]);
        } else {
            echo json_encode(["error" => "Email ou senha incorretos"]);
        }
    }
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new UserController();
    $controller->login();
}




?>