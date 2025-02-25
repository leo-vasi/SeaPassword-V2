<?php
require_once __DIR__ . '/../controller/PaymentController.php';

if (isset($_GET['id'])) {
    $paymentId = (int) $_GET['id'];
    $paymentController = new PaymentController();

    if ($paymentController->deletePayment($paymentId)) {
        header("Location: test.php?message=Payment deleted successfully.");
        exit();
    } else {
        header("Location: test.php?message=Error deleting payment.");
        exit();
    }
} else {
    header("Location: test.php?message=Invalid request.");
    exit();
}
?>
