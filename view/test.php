<?php

require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../controller/PlanController.php';
require_once __DIR__ . '/../controller/PaymentController.php';
require_once __DIR__ . '/../controller/StorageController.php';

$userController = new UserController();
$userSearchQuery = isset($_GET['user_search']) ? trim($_GET['user_search']) : null;
if ($userSearchQuery !== null && ctype_digit($userSearchQuery)) {
    $user = $userController->getUserById((int)$userSearchQuery);
    $users = $user ? [$user] : [];
} else {
    $users = $userController->getAllUsers();
}

echo '<h1>Search User by ID</h1>';
echo '<form method="GET" action="test.php" style="margin-bottom: 20px;">';
echo '    <label for="user_search">User ID: </label>';
echo '    <input type="text" id="user_search" name="user_search" />';
echo '    <button type="submit">Search</button>';
echo '</form>';

echo '<h1>All Users</h1>';
echo '<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">';
echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Actions</th></tr>';
foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . $user->getId() . '</td>';
    echo '<td>' . $user->getName() . '</td>';
    echo '<td>' . $user->getEmail() . '</td>';
    echo '<td>' . $user->getPassword() . '</td>';
    echo '<td>';
    echo '<a href="edit_user.php?id=' . $user->getId() . '&name=' . urlencode($user->getName()) . '&email=' . urlencode($user->getEmail()) . '&password=' . urlencode($user->getPassword()) . '"><button>Edit</button></a>';
    echo '<button>Delete</button>';
    echo '</td>';
    echo '</tr>';
}

if (empty($users)) {
    echo '<tr><td colspan="5">No users found.</td></tr>';
}

echo '</table>';

$planController = new PlanController();
echo '<h1>All Plans</h1>';
$plans = $planController->getAllPlans();
echo '<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">';
echo '<tr><th>ID</th><th>Name</th><th>Price</th><th>Storage Quantity</th></tr>';
foreach ($plans as $plan) {
    echo '<tr>';
    echo '<td>' . $plan->getId() . '</td>';
    echo '<td>' . $plan->getName() . '</td>';
    echo '<td>' . $plan->getPrice() . '</td>';
    echo '<td>' . $plan->getStorageQtd() . '</td>';
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
    echo '<a href="edit_payment.php?id=' . $payment->getId() . '&plan_name=' . urlencode($payment->getPlan()->getName()) . '&user_name=' . urlencode($payment->getUser()->getName()) . '&card_number=' . urldecode($payment->getCardNumber()) . '&agency=' . urlencode($payment->getAgency()) . '&security_code=' . urlencode($payment->getSecurityCode()) . '&cpf_number=' . urlencode($payment->getCpfNumber()) . '&card_expiration=' . urlencode($payment->getCardExpiration()->format('Y-m-d H:i:s')) . '&payment_date=' . urlencode($payment->getPaymentDate()->format('Y-m-d H:i:s')) . '"><button>Edit</button></a>';
    echo '<button>Delete</button>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';

$storageController = new StorageController();
$storageSearchQuery = isset($_GET['storage_search']) ? trim($_GET['storage_search']) : null;
if ($storageSearchQuery !== null && ctype_digit($storageSearchQuery)) {
    $storage = $storageController->getStorageById((int)$storageSearchQuery);
    $storages = $storage ? [$storage] : [];
} else {
    $storages = $storageController->getAllStorages();
}

echo '<h1>Search Storage by ID</h1>';
echo '<form method="GET" action="test.php" style="margin-bottom: 20px;">';
echo '    <label for="storage_search">Storage ID: </label>';
echo '    <input type="text" id="storage_search" name="storage_search" />';
echo '    <button type="submit">Search</button>';
echo '</form>';
echo '<h1>All Storages</h1>';
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
