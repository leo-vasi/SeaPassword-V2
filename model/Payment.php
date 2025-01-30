<?php

class Payment {
    private int $id;
    private Plan $plan;
    private User $user;
    private string $cardNumber;
    private string $agency;
    private string $securityCode;
    private string $cpfNumber;
    private DateTime $cardExpiration;
    private DateTime $paymentDate;


    public function __construct(?int $id, Plan $plan, User $user, string $cardNumber, string $agency, string $securityCode, string $cpfNumber, DateTime $cardExpiration, DateTime $paymentDate) {
        $this-> id = $id ?? 0;
        $this-> plan = $plan;
        $this-> user = $user;
        $this-> cardNumber = $cardNumber;
        $this-> agency = $agency;
        $this-> securityCode = $securityCode;
        $this-> cpfNumber = $cpfNumber;
        $this-> cardExpiration = $cardExpiration;
        $this-> paymentDate = $paymentDate;
    }

    public function getId(): int {
        return $this-> id;
    }

    public function getPlan(): Plan {
        return $this-> plan;
    }

    public function getUser(): User {
        return $this-> user;
    }


    public function getCardNumber(): string {
        return $this-> cardNumber;
    }

    public function getAgency(): string {
        return $this-> agency;
    }

    public function getSecurityCode(): string {
        return $this-> securityCode;
    }

    public function getCpfNumber(): string {
        return $this-> cpfNumber;
    }

    public function getCardExpiration(): DateTime {
        return $this-> cardExpiration;
    }

    public function getPaymentDate(): DateTime {
        return $this-> paymentDate;
    }

    public function setId(int $id): void {
        $this-> id = $id;
    }

    public function setPlan(Plan $plan): void {
        $this-> plan = $plan;
    }

    public function setUser(User $user): void {
        $this-> user = $user;
    }

    public function setCardNumber(string $cardNumber): void {
        $this-> cardNumber = $cardNumber;
    }

    public function setAgency(string $agency): void {
        $this-> agency = $agency;
    }

    public function setSecurityCode(string $securityCode): void {
        $this-> securityCode = $securityCode;
    }

    public function setCpfNumber(string $cpfNumber): void {
        $this-> cpfNumber = $cpfNumber;
    }

    public function setCardExpiration(DateTime $cardExpiration): void {
        $this-> cardExpiration = $cardExpiration;
    }

    public function setPaymentDate(DateTime $paymentDate): void {
        $this-> paymentDate = $paymentDate;
    }
}

?>