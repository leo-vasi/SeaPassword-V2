<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../model/Payment.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Plan.php';

class PaymentDAO {
    private $connection;

    public function __construct(){
        $connectionFactory = new ConnectionFactory();
        $this->connection = $connectionFactory->getConnection();
    }

    public function getAllPayments(): array {
        $query = '
            SELECT p.*,
            u.user_id, u.user_name, u.user_email, u.user_password,
            pl.plan_id, pl.plan_name, pl.price, pl.storage_quantity
            FROM payments p
            JOIN users u ON p.user_id = u.user_id
            JOIN plans pl ON p.plan_id = pl.plan_id
        ';
        $result = $this->connection->query($query);

        $payments = [];
        while ($row = $result->fetch_assoc()) {
            $user = new User(
                $row['user_id'],
                $row['user_name'],
                $row['user_email'],
                $row['user_password']
            );

            $plan = new Plan(
                $row['plan_id'],
                $row['plan_name'],
                $row['price'],
                $row['storage_quantity']
            );

            $cardExpiration = new DateTime($row['card_expiration_date']);
            $paymentDate = new DateTime($row['payment_date']);
            $payments[] = new Payment(
                $row['payment_id'],
                $plan,
                $user,
                $row['card_number'],
                $row['agency'],
                $row['security_code'],
                $row['cpf_number'],
                $cardExpiration,
                $paymentDate
            );
        }
        return $payments;
    }

    public function updatePayment(Payment $payment): bool {
        $query = 'UPDATE payments SET card_number = ?, agency = ?, security_code = ?, cpf_number = ?, card_expiration_date = ?, payment_date = ? WHERE payment_id = ?';
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('ssssssi', $payment->getCardNumber(), $payment->getAgency(), $payment->getSecurityCode(), $payment->getCpfNumber(), $payment->getCardExpiration()->format('Y-m-d'), $payment->getPaymentDate()->format('Y-m-d'), $payment->getId());
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }


    public function createPayment(Payment $payment): bool {
        $query = 'INSERT INTO payments (user_id, plan_id, card_number, agency, security_code, cpf_number, card_expiration_date, payment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->connection->prepare($query);

        if (!$stmt) {
            die("Error preparing query: " . $this->connection->error);
        } else {
            $planId = $payment->getPlan()->getId();
            $userId = $payment->getUser()->getId();
            $cardNumber = $payment->getCardNumber();
            $agency  = $payment->getAgency();
            $securityCode = $payment->getSecurityCode();
            $cpfNumber = $payment->getCpfNumber();
            $cardExpiration = $payment->getCardExpiration()->format('Y-m-d');
            $paymentDate = $payment->getPaymentDate()->format('Y-m-d');
            $stmt->bind_param("iissssss", $planId, $userId, $cardNumber, $agency, $securityCode, $cpfNumber, $cardExpiration, $paymentDate);
            $success = $stmt->execute();
            $stmt->close();
            return $success;
        }
    }

}
