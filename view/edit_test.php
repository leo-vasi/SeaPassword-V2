<?php

require_once __DIR__ . '/../controller/UserController.php';

$id = $_GET['id'] ?? null;
$name = $_GET['name'] ?? '';
$email = $_GET['email'] ?? '';
$password = $_GET['password'] ?? '';


if (!$id) {
    header('Location: test.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedName = $_POST['name'];
    $updatedEmail = $_POST['email'];
    $updatePassword = $_POST['password'];
    $userController = new UserController();
    $userController->updateUser($id, $updatedName, $updatedEmail, $updatePassword);
    header('Location: test.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($password) ?>" required><br><br>
        <button type="submit">Save</button>
        <a href="test.php">
            <button type="button">Cancel</button>
        </a>
    </form>
</body>
</html>
?>