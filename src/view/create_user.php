<?php
require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../model/User.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        $message = "⚠️ All fields are mandatory";
    } else {
        $user = new User(null, $name, $email, $password);
        $userController = new UserController();
        if ($userController->createUser($user)) {
            $message = "✅ User successfully created ";
        } else {
            $message = "❌ Error creating user";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a new User</title>
</head>
<body>

    <h2>Create New User</h2>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">FINISH</button>
    </form>

    <br>
    <a href="test.php">Back to test view</a>

</body>
</html>
