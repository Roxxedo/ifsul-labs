<?php

namespace Source\Models\Hospital;

class User {
    private $id;
    private $name;
    private $email;
    private $senha;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $senha = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function show() {
        echo "Usuário: #{$this->getId()} - Nome: {$this->getName()} - Email: {$this->getEmail()}";
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
}