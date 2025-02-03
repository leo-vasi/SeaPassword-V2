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

$planController = new PlanController();
$plans = $planController->getAllPlans();

$paymentController = new PaymentController();
$payments = $paymentController->getAllPayments();

$storageController = new StorageController();
$storageSearchQuery = isset($_GET['storage_search']) ? trim($_GET['storage_search']) : null;
if ($storageSearchQuery !== null && ctype_digit($storageSearchQuery)) {
    $storage = $storageController->getStorageById((int)$storageSearchQuery);
    $storages = $storage ? [$storage] : [];
} else {
    $storages = $storageController->getAllStorages();
}

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Test Page</title>
</head>
<body>

<h1>Search User by ID</h1>
<form method="GET" action="test.php" style="margin-bottom: 20px;">
    <label for="user_search">User ID: </label>
    <input type="text" id="user_search" name="user_search" />
    <button type="submit">Search</button>
</form>

<h1>All Users</h1>
<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th><th>Actions</th></tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user->getId(); ?></td>
            <td><?= $user->getName(); ?></td>
            <td><?= $user->getEmail(); ?></td>
            <td><?= $user->getPassword(); ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user->getId(); ?>&name=<?= urlencode($user->getName()); ?>&email=<?= urlencode($user->getEmail()); ?>&password=<?= urlencode($user->getPassword()); ?>">
                    <button>Edit</button>
                </a>
                <button>Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>

    <?php if (empty($users)): ?>
        <tr><td colspan="5">No users found.</td></tr>
    <?php endif; ?>
</table>

<h2>Create a new User</h2>
<a href="create_user.php">
    <button>Click here to create a new User</button>
</a>


<h1>All Plans</h1>
<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">
    <tr><th>ID</th><th>Name</th><th>Price</th><th>Storage Quantity</th></tr>
    <?php foreach ($plans as $plan): ?>
        <tr>
            <td><?= $plan->getId(); ?></td>
            <td><?= $plan->getName(); ?></td>
            <td><?= $plan->getPrice(); ?></td>
            <td><?= $plan->getStorageQtd(); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1>All Payments</h1>
<?php if (isset($_GET['message'])): ?>
    <p><?php echo htmlspecialchars($_GET['message']); ?></p>
<?php endif; ?>

<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">
    <tr><th>ID</th><th>Plan</th><th>User</th><th>Card Number</th><th>Agency</th><th>Security Code</th><th>CPF</th><th>Card Expiration</th><th>Payment Date</th><th>Actions</th></tr>
    <?php foreach ($payments as $payment): ?>
        <tr>
            <td><?= $payment->getId(); ?></td>
            <td><?= $payment->getPlan()->getName(); ?></td>
            <td><?= $payment->getUser()->getName(); ?></td>
            <td><?= $payment->getCardNumber(); ?></td>
            <td><?= $payment->getAgency(); ?></td>
            <td><?= $payment->getSecurityCode(); ?></td>
            <td><?= $payment->getCpfNumber(); ?></td>
            <td><?= $payment->getCardExpiration()->format('Y-m-d H:i:s'); ?></td>
            <td><?= $payment->getPaymentDate()->format('Y-m-d H:i:s'); ?></td>
            <td>
                <a href="edit_payment.php?id=<?= $payment->getId(); ?>">
                    <button>Edit</button>
                </a>
                <a href="delete_payment.php?id=<?= $payment->getId(); ?>" onclick="return confirm('Do you really want to delete this payment?')">
                    <button>Delete</button>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Add a new Payment</h2>
<a href="create_payment.php">
    <button>Click here to add a new payment</button>
</a>

<h1>Search Storage by ID</h1>
<form method="GET" action="test.php" style="margin-bottom: 20px;">
    <label for="storage_search">Storage ID: </label>
    <input type="text" id="storage_search" name="storage_search" />
    <button type="submit">Search</button>
</form>

<h1>All Storages</h1>
<table border="1" style="width:100%; text-align:left; margin-bottom:20px;">
    <tr><th>ID</th><th>User</th><th>Description</th><th>Email</th><th>Password</th><th>Actions</th></tr>
    <?php foreach ($storages as $storage): ?>
        <tr>
            <td><?= $storage->getId(); ?></td>
            <td><?= $storage->getUser()->getName(); ?></td>
            <td><?= $storage->getDescriptionStrg(); ?></td>
            <td><?= $storage->getEmailStrg(); ?></td>
            <td><?= $storage->getPasswordStrg(); ?></td>
            <td>
                <a href="edit_storage.php?id=<?= $storage->getId();?>">
                    <button>Edit</button>
                </a>
                <button>Delete</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Storage new Login data</h2>
<a href="create_storage.php">
    <button>Click here to store new login data</button>
</a>

</body>
</html>
