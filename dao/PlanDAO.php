<?php

require_once __DIR__ . '/../config/ConnectionFactory.php';
require_once __DIR__ . '/../entities/Plan.php';

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
}

?>
