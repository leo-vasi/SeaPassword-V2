<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../entities/Payment.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../entities/Plan.php';

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

}
