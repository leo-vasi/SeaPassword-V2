<?php
require_once __DIR__ . '/../controller/PaymentController.php';
require_once __DIR__ . '/../controller/PlanController.php';
require_once __DIR__ . '/../controller/UserController.php';
require_once __DIR__ . '/../model/Payment.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $planId = isset($_POST['plan_id']) ? (int) $_POST['plan_id'] : null;
    $userId = isset($_POST['user_id']) ? (int) $_POST['user_id'] : null;
    $cardNumber = trim($_POST['card_number']);
    $agency  = trim($_POST['agency']);
    $securityCode = trim($_POST['security_code']);
    $cpfNumber = trim($_POST['cpf_number']);
    try {
        $cardExpiration = new DateTime(trim($_POST['card_expiration']));
        $paymentDate = new DateTime(trim($_POST['payment_date']));
    } catch (Exception $e) {
        $message = "❌ Erro ao processar datas: " . $e->getMessage();
        return;
    }

    if (empty($planId) || empty($userId) || empty($cardNumber) || empty($agency) || empty($securityCode) || empty($cpfNumber) || empty($cardExpiration) || empty($paymentDate)) {
        $message = "⚠️ All fields are mandatory";
    } else {
        $planController = new PlanController();
        $userController = new UserController();
        $plan = $planController->getPlanById($planId);
        $user = $userController->getUserById($userId);

        if (!$plan || !$user) {
            $message = "❌ Plan or User not found";
        } else {
            $payment = new Payment(null, $plan, $user, $cardNumber, $agency, $securityCode, $cpfNumber, $cardExpiration, $paymentDate);
            $paymentController = new PaymentController();

            if ($paymentController->createPayment($payment)) {
                $message = "Payment added";
            } else {
                $message = "Error";
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
    <title>Create a new Payment</title>
</head>
<body>

    <h2>Create New Payment</h2>

    <?php if (!empty($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="plan_id">Plan ID:</label>
        <input type="number" id="plan_id" name="plan_id" required>

        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required>

        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" required>

        <label for="agency">Agency:</label>
        <input type="text" id="agency" name="agency" required>

        <label for="security_code">Security Code:</label>
        <input type="number" id="security_code" name="security_code" required>

        <label for="cpf_number">CPF Number:</label>
        <input type="text" id="cpf_number" name="cpf_number" required>

        <label for="card_expiration">Card Expiration:</label>
        <input type="date" name="card_expiration" id="card_expiration" required>

        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" id="payment_date" required>

        <button type="submit">FINISH</button>
    </form>

    <br>
    <a href="test.php">Back to test view</a>

</body>
</html>
