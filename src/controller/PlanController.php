<?php
require_once __DIR__ . '/../dao/PlanDAO.php';

class PlanController {
    private PlanDAO $planDAO;
    public function __construct() {
        $this-> planDAO = new PlanDAO();
    }

    public function getAllPlans(): array {
        return $this-> planDAO -> getAllPlans();
    }

    public function getPlanById(int $id): ?Plan {
        return $this->planDAO-> getPlanById($id);
    }

}

?>