<?php
require_once __DIR__ . '/../controller/StorageController.php';
require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../model/Storage.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = isset($_POST['user_id']) ? (int) $_POST['user_id'] : null;
    $storageDescription = trim($_POST['storage_description']);
    $storageEmail = trim($_POST['storage_email']);
    $storagePassword = trim($_POST['storage_password']);

    if (empty($userId) || empty($storageDescription) || empty($storageEmail) || empty($storagePassword)) {
        $message = "Todos os campos são obrigatórios";
    } else {
        $userController = new UserController();
        $user = $userController->getUserById($userId);

        if (!$user) {
            $message = "Usuário não encontrado";
        } else {
            $storage = new Storage(null, $user, $storageDescription, $storageEmail, $storagePassword);
            $storageController = new StorageController();

            if ($storageController->createStorage($storage)) {
                $message = "Armazenamento criado com sucesso!";
            } else {
                $message = "Erro ao criar armazenamento";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar novo armazenamento</title>
</head>
<body>

    <h2>Criar Novo Armazenamento</h2>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="user_id">ID do Usuário:</label>
        <input type="number" id="user_id" name="user_id" required>

        <label for="storage_description">Descrição:</label>
        <input type="text" id="storage_description" name="storage_description" required>

        <label for="storage_email">E-mail de Acesso:</label>
        <input type="email" id="storage_email" name="storage_email" required>

        <label for="storage_password">Senha:</label>
        <input type="password" id="storage_password" name="storage_password" required>

        <button type="submit">Criar Armazenamento</button>
    </form>

    <br>
    <a href="test.php">Voltar para a página de testes</a>

</body>
</html>
