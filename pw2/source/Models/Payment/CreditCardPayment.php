<?php

namespace Source\Models\Payment;

class CreditCardPayment extends Payment {
    private string $cardLastDigits;
    private int $installments;
    private float $feeRate;

    public function __construct(int $id, float $amount, string $description, string $cardLastDigits, int $installments, float $feeRate) {
        parent::__construct($id, $amount, $description);
        $this->cardLastDigits = $cardLastDigits;
        $this->installments = $installments < 1 ? 1 : $installments;
        $this->feeRate = $feeRate;
    }

    public function getCardLastDigits(): string {
        return $this->cardLastDigits;
    }

    public function setCardLastDigits(string $cardLastDigits) {
        $this->cardLastDigits = $cardLastDigits;
    }

    public function getInstallments(): int {
        return $this->installments;
    }

    public function setInstallments(int $installments) {
        $this->installments = $installments < 1 ? 1 : $installments;
    }

    public function getFeeRate(): float {
        return $this->feeRate;
    }

    public function setFeeRate(float $feeRate) {
        $this->feeRate = $feeRate;
    }

    public function calculateFee(): float {
        return $this->getAmount() * $this->feeRate / 100;
    }

    public function process(): string {
        $this->setStatus("aprovado");
        $installmentValue = ($this->getAmount() + $this->calculateFee()) / $this->installments;

        return "✅ Cartão **** {$this->cardLastDigits} aprovado | {$this->installments}x de R$ " . number_format($installmentValue, 2, ",", ".");
    }

    public function show(): string {
        $fee = $this->calculateFee();
        $total = $this->getAmount() + $fee;

        return "
            Pagamento com Cartão de Crédito: #{$this->getId()} <br>
            Descrição: {$this->getDescription()} <br>
            Cartão: **** {$this->cardLastDigits} <br>
            Parcelas: {$this->installments}x <br>
            Valor: R$ " . number_format($this->getAmount(), 2, ",", ".") . " <br>
            Taxa Percentual: " . number_format($this->feeRate, 2, ",", ".") . "% <br>
            Taxa: R$ " . number_format($fee, 2, ",", ".") . " <br>
            Valor Total: R$ " . number_format($total, 2, ",", ".") . " <br>
            Status: {$this->getStatus()} <br>
        ";
    }
}
