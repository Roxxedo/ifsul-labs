<?php

namespace Source\Models\Payment;

class BoletoPayment extends Payment {
    private string $barCode;
    private string $dueDate;
    private float $issuanceFee;

    public function __construct(int $id, float $amount, string $description, string $barCode, string $dueDate, float $issuanceFee) {
        parent::__construct($id, $amount, $description);
        $this->barCode = $barCode;
        $this->dueDate = $dueDate;
        $this->issuanceFee = $issuanceFee;
    }

    public function getBarCode(): string {
        return $this->barCode;
    }

    public function setBarCode(string $barCode) {
        $this->barCode = $barCode;
    }

    public function getDueDate(): string {
        return $this->dueDate;
    }

    public function setDueDate(string $dueDate) {
        $this->dueDate = $dueDate;
    }

    public function getIssuanceFee(): float {
        return $this->issuanceFee;
    }

    public function setIssuanceFee(float $issuanceFee) {
        $this->issuanceFee = $issuanceFee;
    }

    public function calculateFee(): float {
        return $this->issuanceFee;
    }

    public function process(): string {
        $this->setStatus("pendente");
        $total = $this->getAmount() + $this->calculateFee();

        return "🧾 Boleto gerado! Vencimento: {$this->dueDate} | Valor Total: R$ " . number_format($total, 2, ",", ".");
    }

    public function show(): string {
        $fee = $this->calculateFee();
        $total = $this->getAmount() + $fee;

        return "
            Pagamento com Boleto: #{$this->getId()} <br>
            Descrição: {$this->getDescription()} <br>
            Código de Barras: {$this->barCode} <br>
            Vencimento: {$this->dueDate} <br>
            Compensação: Até 3 dias úteis <br>
            Valor: R$ " . number_format($this->getAmount(), 2, ",", ".") . " <br>
            Taxa de Emissão: R$ " . number_format($this->issuanceFee, 2, ",", ".") . " <br>
            Valor Total: R$ " . number_format($total, 2, ",", ".") . " <br>
            Status: {$this->getStatus()} <br>
        ";
    }
}
