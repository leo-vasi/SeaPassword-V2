<?php
require_once __DIR__ . '/../controller/UserController.php';

if (isset($_GET['id'])) {
    $userId = (int) $_GET['id'];
    $userController = new UserController();

    if ($userController->deleteUser($userId)) {
        header("Location: test.php?message=User deleted successfully.");
        exit();
    } else {
        header("Location: test.php?message=Error deleting user.");
        exit();
    }
} else {
    header("Location: test.php?message=Invalid request.");
    exit();
}
?>
