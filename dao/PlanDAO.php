<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../model/Plan.php';

class PlanDAO {
    private $connection;

    public function __construct(){
        $connectionFactory = new ConnectionFactory();
        $this->connection = $connectionFactory->getConnection();
    }

    public function getAllPlans(): array {
        $query = 'SELECT * FROM plans';
        $result = $this->connection->query($query);

        $plans = [];
        while ($row = $result->fetch_assoc()) {
            $plans[] = new Plan(
                $row['plan_id'],
                $row['plan_name'],
                $row['price'],
                $row['storage_quantity']
            );
        }
        return $plans;
    }


    public function getPlanById(int $id): ?Plan {
        $query = 'SELECT * FROM plans WHERE plan_id = ?';
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            return new Plan($row['plan_id'], $row['plan_name'], $row['price'], $row['storage_quantity']);
        }
        return null;
    }
}

?>
