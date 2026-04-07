<?php

namespace Source\Models\Banking;

use Source\Models\Banking\Transaction;

class BankAccount {
    private int $id;
    private string $ownerName;
    private string $accountNumber;
    private float $balance;
    private string $pin;
    private array $transactions;

    public function __construct(int $id, string $ownerName, string $accountNumber, string $pin) {
        $this->id = $id;
        $this->ownerName = $ownerName;
        $this->accountNumber = $accountNumber;
        $this->balance = 0.0;
        $this->pin = md5($pin);
        $this->transactions = [];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getOwnerName(): string {
        return $this->ownerName;
    }

    public function getAccountNumber(): string {
        return $this->accountNumber;
    }
    
    public function getBalance(): float {
        return $this->balance;
    }

    public function validatePin(string $pin): bool {
        return $this->pin === md5($pin);
    }

    public function changePin(string $currentPin, string $newPin): bool {
        if (!$this->validatePin($currentPin)) {
            return false;
        }

        $this->pin = md5($newPin);
        return true;
    }

    public function deposit(float $amount, string $description = "Depósito"): bool {
        if ($amount <= 0) {
            return false;
        }

        $this->balance += $amount;
        $this->transactions[] = new Transaction("deposito", $amount, $description);
        return true;
    }

    public function withdraw(float $amount, string $pin, string $description = "Saque"): bool {
        if (!$this->validatePin($pin) || $amount <= 0 || $amount > $this->balance) {
            return false;
        }

        $this->balance -= $amount;
        $this->transactions[] = new Transaction("saque", $amount, $description);
        return true;
    }

    public function transfer(float $amount, string $pin, BankAccount $destinationAccount, string $description = "Transferência"): bool {
        if (!$this->validatePin($pin) || $amount <= 0 || $amount > $this->balance) {
            return false;
        }

        $this->balance -= $amount;
        $destinationAccount->balance += $amount;

        $this->transactions[] = new Transaction("transferencia", $amount, $description . " enviada para {$destinationAccount->getOwnerName()}");
        $destinationAccount->transactions[] = new Transaction("transferencia", $amount, $description . " recebida de {$this->ownerName}");

        return true;
    }

    public function getTransactions(): array {
        return $this->transactions;
    }

    public function show(): string {
        return "
            Conta Bancária: #{$this->id} <br>
            Titular: {$this->ownerName} <br>
            Número da Conta: {$this->accountNumber} <br>
            Saldo: R$ " . number_format($this->balance, 2, ",", ".") . " <br>
            Transações registradas: " . count($this->transactions) . " <br>
        ";
    }
}