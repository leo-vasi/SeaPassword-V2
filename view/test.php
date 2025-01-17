<?php

require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../controller/PlanController.php';
require_once __DIR__ . '/../controller/PaymentController.php';
require_once __DIR__ . '/../controller/StorageController.php';

$userController = new UserController();
echo '<h1>All Users</h1>';
$users = $userController->getAllUsers();
echo '<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">';
echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Actions</th></tr>';
foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user->getId() . '</td>';
    echo '<td>' . $user->getName() . '</td>';
    echo '<td>' . $user->getEmail() . '</td>';
    echo '<td>' . $user->getPassword() . '</td>';
    echo '<td>';
    echo '<a href="edit_user.php?id=' . $user->getId() . '&name=' . urlencode($user->getName()) . '&email=' . urlencode($user->getEmail()) . '&password=' . urlencode($user->getPassword()) .'"><button>Edit</button></a>';
    echo '<button>Delete</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

$planController = new PlanController();
echo '<h1>All Plans</h1>';
$plans = $planController->getAllPlans();
echo '<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">';
echo '<tr><th>ID</th><th>Name</th><th>Price</th><th>Storage Quantity</th><th>Actions</th></tr>';
foreach ($plans as $plan) {
    echo '<tr>';
    echo '<td>' . $plan->getId() . '</td>';
    echo '<td>' . $plan->getName() . '</td>';
    echo '<td>' . $plan->getPrice() . '</td>';
    echo '<td>' . $plan->getStorageQtd() . '</td>';
    echo '<td>';
    echo '<button>Edit</button>';
    echo '<button>Delete</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

$paymentController = new PaymentController();
echo '<h1>All Payments</h1>';
$payments = $paymentController->getAllPayments();
echo '<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">';
echo '<tr><th>ID</th><th>Plan</th><th>User</th><th>Card Number</th><th>Agency</th><th>Security Code</th><th>CPF</th><th>Card Expiration</th><th>Payment Date</th><th>Actions</th></tr>';
foreach ($payments as $payment) {
    echo '<tr>';
    echo '<td>' . $payment->getId() . '</td>';
    echo '<td>' . $payment->getPlan()->getName() . '</td>';
    echo '<td>' . $payment->getUser()->getName() . '</td>';
    echo '<td>' . $payment->getCardNumber() . '</td>';
    echo '<td>' . $payment->getAgency() . '</td>';
    echo '<td>' . $payment->getSecurityCode() . '</td>';
    echo '<td>' . $payment->getCpfNumber() . '</td>';
    echo '<td>' . $payment->getCardExpiration()->format('Y-m-d H:i:s') . '</td>';
    echo '<td>' . $payment->getPaymentDate()->format('Y-m-d H:i:s') . '</td>';
    echo '<td>';
    echo '<a href="edit_payment.php?id=' . $payment->getId() . '&plan_name=' . urlencode($payment->getPlan()->getName()) . '&user_name=' . urlencode($payment->getUser()->getName()) . '&card_number=' . urldecode($payment->getCardNumber()) . '&agency=' . urlencode($payment->getAgency()) . '&security_code=' . urlencode($payment->getSecurityCode()) . '&cpf_number=' . urlencode($payment->getCpfNumber()) . '&card_expiration=' . urlencode($payment->getCardExpiration()->format('Y-m-d H:i:s')) . '&payment_date=' . urlencode($payment->getPaymentDate()->format('Y-m-d H:i:s')) .'"><button>Edit</button></a>';
    echo '<button>Delete</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

$storageController = new StorageController();
echo '<h1>All Storages</h1>';
$storages = $storageController->getAllStorages();
echo '<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">';
echo '<tr><th>ID</th><th>User</th><th>Description</th><th>Email</th><th>Password</th><th>Actions</th></tr>';
foreach ($storages as $storage) {
    echo '<tr>';
    echo '<td>' . $storage->getId() . '</td>';
    echo '<td>' . $storage->getUser()->getName() . '</td>';
    echo '<td>' . $storage->getDescriptionStrg() . '</td>';
    echo '<td>' . $storage->getEmailStrg() . '</td>';
    echo '<td>' . $storage->getPasswordStrg() . '</td>';
    echo '<td>';
    echo '<button>Edit</button>';
    echo '<button>Delete</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

?>
