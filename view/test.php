<?php

require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . '/../dao/PlanDAO.php';

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

$planDAO = new PlanDAO();
$plans = $planDAO->getAllPlans();

echo '<h1>All Plans</h1>';
foreach ($plans as $plan) {
    echo '<p>';
    echo 'ID: ' . $plan->getId() . '<br>';
    echo 'Name: ' . $plan->getName() . '<br>';
    echo 'Price: ' . $plan->getPrice() . '<br>';
    echo 'Storage Quantity: ' . $plan->getStorageQtd() . '<br>';
    echo '</p>';
}



?>