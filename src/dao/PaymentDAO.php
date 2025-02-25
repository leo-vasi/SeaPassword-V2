<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../model/Payment.php';
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Plan.php';
require_once __DIR__ . '/../exceptions/InvalidDataException.php';

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


    public function getPaymentById(int $id): ?Payment {
        $query = '
            SELECT p.*,
            u.user_id, u.user_name, u.user_email, u.user_password,
            pl.plan_id, pl.plan_name, pl.price, pl.storage_quantity
            FROM payments p
            JOIN users u ON p.user_id = u.user_id
            JOIN plans pl ON p.plan_id = pl.plan_id
            WHERE p.payment_id = ?
        ';
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a consulta: " . $this->connection->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
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
            return new Payment(
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
        return null;
    }


    public function createPayment(Payment $payment): bool {
        if (empty($payment->getCardNumber()) || empty($payment->getAgency()) || empty($payment->getSecurityCode()) || empty($payment->getCpfNumber())) {
            throw new InvalidDataException("Os dados do cartão estão incompletos ou inválidos.");
        }
        $query = 'INSERT INTO payments (user_id, plan_id, card_number, agency, security_code, cpf_number, card_expiration_date, payment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a query: " . $this->connection->error);
        }
        $stmt->bind_param(
            "iissssss",
            $payment->getUser()->getId(),
            $payment->getPlan()->getId(),
            $payment->getCardNumber(),
            $payment->getAgency(),
            $payment->getSecurityCode(),
            $payment->getCpfNumber(),
            $payment->getCardExpiration()->format('Y-m-d'),
            $payment->getPaymentDate()->format('Y-m-d')
        );
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }



    public function updatePayment(Payment $payment): bool {
        if (empty($payment->getCardNumber()) || empty($payment->getAgency()) || empty($payment->getSecurityCode()) || empty($payment->getCpfNumber())) {
            throw new InvalidDataException("Os dados do cartão estão incompletos ou inválidos.");
        }
        $query = 'UPDATE payments SET card_number = ?, agency = ?, security_code = ?, cpf_number = ?, card_expiration_date = ?, payment_date = ? WHERE payment_id = ?';
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Erro ao preparar a query: " . $this->connection->error);
        }
        $stmt->bind_param(
            'ssssssi',
            $payment->getCardNumber(),
            $payment->getAgency(),
            $payment->getSecurityCode(),
            $payment->getCpfNumber(),
            $payment->getCardExpiration()->format('Y-m-d'),
            $payment->getPaymentDate()->format('Y-m-d'),
            $payment->getId()
        );
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }


    public function deletePayment(int $id): bool {
        $query = "DELETE FROM payments WHERE payment_id = ?";
        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            die("Error preparing query: " . $this->connection->error);
        }
        $stmt->bind_param("i", $id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }




}
