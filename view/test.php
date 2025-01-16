<?php

require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../dao/PlanDAO.php';
require_once __DIR__ . '/../dao/PaymentDAO.php';
require_once __DIR__ . '/../dao/StorageDAO.php';

$userController = new UserController();

echo '<h1>All Users</h1>';
$users = $userController->getAllUsers();
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

$paymentDAO = new PaymentDAO();
$payments = $paymentDAO->getAllPayments();

echo '<h1>All Payments</h1>';
foreach ($payments as $payment) {
    echo '<p>';
    echo 'ID: ' . $payment->getId() . '<br>';
    echo 'Plan: ' . $payment->getPlan()->getName() . '<br>';
    echo 'User: ' . $payment->getUser()->getName() . '<br>';
    echo 'Card Number: ' . $payment->getCardNumber() . '<br>';
    echo 'Agency: ' . $payment->getAgency() . '<br>';
    echo 'Security Code: ' . $payment->getSecurityCode() . '<br>';
    echo 'CPF: ' . $payment->getCpfNumber() . '<br>';
    echo 'Card Expiration: ' . $payment->getCardExpiration()->format('Y-m-d H:i:s') . '<br>';
    echo 'Payment Date: ' . $payment->getPaymentDate()->format('Y-m-d H:i:s') . '<br>';
    echo '</p>';
}

$storageDAO = new StorageDAO();
$storages = $storageDAO->getAllStorages();

echo '<h1>All Storages</h1>';
foreach ($storages as $storage) {
    echo '<p>';
    echo 'ID: ' . $storage->getId() . '<br>';
    echo 'User: ' . $storage->getUser()->getName() . '<br>';
    echo 'Description: ' . $storage->getDescriptionStrg() . '<br>';
    echo 'Email: ' . $storage->getEmailStrg() . '<br>';
    echo 'Password: ' . $storage->getPasswordStrg() . '<br>';
    echo '</p>';
}

?>