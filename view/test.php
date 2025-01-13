<?php

require_once __DIR__ . '/../dao/UserDAO.php';

$userDAO = new UserDAO();
$users = $userDAO->getAllUsers();

echo '<h1>All Users</h1>';
foreach ($users as $user) {
    echo '<p>';
    echo 'ID: ' . $user->getId() . '<br>';
    echo 'Name: ' . $user->getName() . '<br>';
    echo 'Email: ' . $user->getEmail() . '<br>';
    echo '</p>';
}

?>