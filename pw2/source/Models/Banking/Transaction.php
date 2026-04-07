<?php

namespace Source\Models\Banking;

class Transaction {
    private string $type;
    private float $amount;
    private string $description;
    private string $createdAt;

    public function __construct(string $type, float $amount, string $description) {
        $this->type = $type;
        $this->amount = $amount;
        $this->description = $description;
        $this->createdAt = date("Y-m-d H:i:s");
    }

    public function getType(): string {
        return $this->type;
    }

    public function getAmount(): float {
        return $this->amount;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function show(): string {
        $types = [
            "deposito" => "Depósito",
            "saque" => "Saque",
            "transferencia" => "Transferência"
        ];

        $type = $types[$this->type] ?? ucfirst($this->type);

        return "[{$this->createdAt}] {$type} | Valor: R$ " . number_format($this->amount, 2, ",", ".") . " | Descrição: {$this->description}";
    }
}