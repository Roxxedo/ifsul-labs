<?php

namespace Source\Models\Banking;

class SavingsAccount extends BankAccount {
    private float $yieldRate;
    private string $lastYieldDate;

    public function __construct(int $id, string $ownerName, string $accountNumber, string $pin, float $yieldRate) {
        parent::__construct($id, $ownerName, $accountNumber, $pin);
        $this->yieldRate = $yieldRate;
        $this->lastYieldDate = date("Y-m-d");
    }

    public function getYieldRate(): float {
        return $this->yieldRate;
    }

    public function setYieldRate(float $yieldRate) {
        $this->yieldRate = $yieldRate;
    }

    public function getLastYieldDate(): string {
        return $this->lastYieldDate;
    }

    public function setLastYieldDate(string $lastYieldDate) {
        $this->lastYieldDate = $lastYieldDate;
    }

    public function applyYield(): float {
        $yield = $this->getBalance() * $this->yieldRate / 100;

        if ($yield > 0) {
            $this->deposit($yield, "Rendimento da poupança");
        }

        $this->lastYieldDate = date("Y-m-d");
        return $yield;
    }

    public function show(): string {
        return "
            Conta Poupança: #{$this->getId()} <br>
            Titular: {$this->getOwnerName()} <br>
            Número da Conta: {$this->getAccountNumber()} <br>
            Saldo: R$ " . number_format($this->getBalance(), 2, ",", ".") . " <br>
            Taxa de Rendimento: " . number_format($this->yieldRate, 2, ",", ".") . "% ao mês <br>
            Último Rendimento: {$this->lastYieldDate} <br>
            Transações registradas: " . count($this->getTransactions()) . " <br>
        ";
    }
}