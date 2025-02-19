<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../exceptions/UserNotFoundException.php';

class UserDAO {
    private $connection;

    public function __construct(){
        $connectionFactory = new ConnectionFactory();
        $this->connection = $connectionFactory->getConnection();
    }

    public function getAllUsers(): array {
        $query = 'SELECT * FROM users';
        $result = $this->connection->query($query);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = new User(
                $row['user_id'],
                $row['user_name'],
                $row['user_email'],
                $row['user_password']
            );
        }
        return $users;
    }

    public function getUserById(int $id): ?User {
        $query = 'SELECT * FROM users WHERE user_id = ?';
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new User($row['user_id'], $row['user_name'], $row['user_email'], $row['user_password']);
        }
        throw new UserNotFoundException("Usuário com ID $id não encontrado");
    }

    public function createUser(User $user): bool {
        $query = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die("Erro na preparação da query: " . $this->connection->error);
        }
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $name = $user->getName();
        $email = $user->getEmail();
        $stmt->bind_param("sss", $name, $email, $hashedPassword);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function updateUser(User $user): bool {
        $this->getUserById($user->getId());
        $query = 'UPDATE users SET user_name = ?, user_email = ?, user_password = ? WHERE user_id = ?';
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('sssi', $user->getName(), $user->getEmail(), $user->getPassword(), $user->getId());
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }


    public function deleteUser(int $id): bool {
        $this->getUserById($id);
        $query = "DELETE FROM users WHERE user_id = ?";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die("Error preparing query: " . $this->connection->error);
        }
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }


}


?>
