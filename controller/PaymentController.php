<?php
require_once __DIR__ . '/../dao/PaymentDAO.php';

class PaymentController {
    private PaymentDAO $paymentDAO;
    public function __construct() {
        $this-> paymentDAO = new PaymentDAO();
    }

    public function getAllPayments(): array {
        return $this-> paymentDAO-> getAllPayments();
    }
}

?>