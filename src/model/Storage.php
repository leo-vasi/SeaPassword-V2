<?php

class Storage {
    private int $id;
    private User $user;
    private string $descriptionStrg; // Strg == Storage
    private string $emailStrg; // Strg == Storage
    private string $passwordStrg; // Strg == Storage

    public function __construct(?int $id, User $user, string $descriptionStrg, string $emailStrg, string $passwordStrg) {
        $this-> id = $id ?? 0;
        $this-> user = $user;
        $this-> descriptionStrg = $descriptionStrg;
        $this-> emailStrg = $emailStrg;
        $this-> passwordStrg = $passwordStrg;
    }

    public function getId(): int {
        return $this-> id;
    }

    public function getUser(): User {
        return $this-> user;
    }

    public function getDescriptionStrg(): string {
        return $this-> descriptionStrg;
    }

    public function getEmailStrg(): string {
        return $this-> emailStrg;
    }

    public function getPasswordStrg(): string {
        return $this-> passwordStrg;
    }

    public function setId(int $id): void {
        $this-> id = $id;
    }

    public function setUser(User $user): void {
        $this-> user = $user;
    }

    public function setDescriptionStrg(string $descriptionStrg): void {
        $this-> descriptionStrg = $descriptionStrg;
    }

    public function setEmailStrg(string $emailStrg): void {
        $this-> emailStrg = $emailStrg;
    }

    public function setPasswordStrg(string $passwordStrg): void {
        $this-> passwordStrg = $passwordStrg;
    }
}

?>