<?php
require_once __DIR__ . '/../dao/PaymentDAO.php';
require_once __DIR__ . '/../exceptions/InvalidDataException.php';

class PaymentController {
    private PaymentDAO $paymentDAO;
    public function __construct() {
        $this-> paymentDAO = new PaymentDAO();
    }

    public function getAllPayments(): array {
        return $this-> paymentDAO-> getAllPayments();
    }

    public function getPaymentById(int $id): ?Payment {
        return $this->paymentDAO->getPaymentById($id);
    }

    public function updatePayment(int $id, int $userId, int $planId, string $cardNumber, string $agency, string $securityCode, string $cpfNumber, DateTime $cardExpiration, DateTime $paymentDate): bool {
        $user = new User($userId, '', '', '');
        $plan = new Plan($planId, '', 0.0, 0);
        $payment = new Payment($id, $plan, $user, $cardNumber, $agency, $securityCode, $cpfNumber, $cardExpiration, $paymentDate);
        return $this->paymentDAO->updatePayment($payment);
    }

    public function createPayment(Payment $payment): bool {
        return $this->paymentDAO->createPayment($payment);
    }

    public function deletePayment(int $id): bool {
        return $this->paymentDAO->deletePayment($id);
    }

}

?>