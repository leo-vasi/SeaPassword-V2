<?php

class Plan {
    private int $id;
    private string $name;
    private float $price;
    private int $storage_qtd;

    public function __construct(int $id, string $name, float $price, int $storage_qtd) {
        $this-> id = $id;
        $this-> name = $name;
        $this-> price = $price;
        $this-> storage_qtd = $storage_qtd;
    }

    public function getId(): int {
        return $this-> id;
    }

    public function getName(): string {
        return $this-> name;
    }

    public function getPrice(): float {
        return $this-> price;
    }

    public function getStorageQtd(): int {
        return $this-> storage_qtd;
    }
}

?>