<?php

require_once __DIR__ . '/../controller/StorageController.php';
require_once __DIR__ . '/../controller/UserController.php';

$storageController = new StorageController();
$userController = new UserController();

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: test.php');
    exit;
}

$storage = $storageController->getStorageById($id);
if (!$storage) {
    echo "Storage not found.";
    exit;
}

$user = $storage->getUser();
$description = $storage->getDescriptionStrg();
$email = $storage->getEmailStrg();
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedDescription = $_POST['description'];
    $updatedEmail = $_POST['email'];
    $updatedPassword = $_POST['password'];
    $storageController->updateStorage($id, $user, $updatedDescription, $updatedEmail, $updatedPassword);
    header('Location: test.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Storage</title>
</head>
<body>
    <h1>Edit Storage</h1>
    <form method="POST">
        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description" value="<?= htmlspecialchars($description) ?>" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>
        <label for="password">New Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Save</button>
        <a href="test.php">
            <button type="button">Cancel</button>
        </a>
    </form>
</body>
</html>
