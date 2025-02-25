<?php

require_once __DIR__ . '/../controller/PaymentController.php';

$id = $_GET['id'] ?? null;
$planName = $_GET['plan_name'] ?? '';
$userName = $_GET['user_name'] ?? '';
$cardNumber = $_GET['card_number'] ?? '';
$agency = $_GET['agency'] ?? '';
$securityCode = $_GET['security_code'] ?? '';
$cpfNumber = $_GET['cpf_number'] ?? '';
$cardExpiration = $_GET['card_expiration'] ?? '';
$paymentDate = $_GET['payment_date'] ?? '';

if (!$id) {
    header('Location: test.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedCardNumber = $_POST['card_number'];
    $updatedAgency = $_POST['agency'];
    $updatedSecurityCode = $_POST['security_code'];
    $updatedCpfNumber = $_POST['cpf_number'];
    $updatedCardExpiration = new DateTime($_POST['card_expiration']);
    $updatedPaymentDate = new DateTime($_POST['payment_date']);

    $paymentController = new PaymentController();
    $paymentController->updatePayment($id, $id, $id, $updatedCardNumber, $updatedAgency, $updatedSecurityCode, $updatedCpfNumber, $updatedCardExpiration, $updatedPaymentDate);
    header('Location: test.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
</head>
<body>
    <h1>Edit Payment</h1>
    <form method="POST">
        <label for="card_number">Card Number:</label><br>
        <input type="text" id="card_number" name="card_number" value="<?= htmlspecialchars($cardNumber) ?>" required><br><br>

        <label for="agency">Agency:</label><br>
        <input type="text" id="agency" name="agency" value="<?= htmlspecialchars($agency) ?>" required><br><br>

        <label for="security_code">Security Code:</label><br>
        <input type="text" id="security_code" name="security_code" value="<?= htmlspecialchars($securityCode) ?>" required><br><br>

        <label for="cpf_number">CPF Number:</label><br>
        <input type="text" id="cpf_number" name="cpf_number" value="<?= htmlspecialchars($cpfNumber) ?>" required><br><br>

        <label for="card_expiration">Card Expiration:</label><br>
        <input type="datetime-local" id="card_expiration" name="card_expiration" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($cardExpiration))) ?>" required><br><br>

        <label for="payment_date">Payment Date:</label><br>
        <input type="datetime-local" id="payment_date" name="payment_date" value="<?= htmlspecialchars(date('Y-m-d\TH:i', strtotime($paymentDate))) ?>" required><br><br>

        <button type="submit">Save</button>
        <a href="test.php">
            <button type="button">Cancel</button>
        </a>
    </form>
</body>
</html>
