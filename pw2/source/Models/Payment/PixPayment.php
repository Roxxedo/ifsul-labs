<?php

namespace Source\Models\Payment;

class PixPayment extends Payment {
    private string $pixKey;
    private string $pixKeyType;

    public function __construct(int $id, float $amount, string $description, string $pixKey, string $pixKeyType) {
        parent::__construct($id, $amount, $description);
        $this->pixKey = $pixKey;
        $this->pixKeyType = $pixKeyType;
    }

    public function getPixKey(): string {
        return $this->pixKey;
    }

    public function setPixKey(string $pixKey) {
        $this->pixKey = $pixKey;
    }

    public function getPixKeyType(): string {
        return $this->pixKeyType;
    }

    public function setPixKeyType(string $pixKeyType) {
        $this->pixKeyType = $pixKeyType;
    }

    public function calculateFee(): float {
        return 0.0;
    }

    public function process(): string {
        $this->setStatus("aprovado");
        return "⚡ Pix aprovado instantaneamente! Chave: {$this->pixKey}";
    }

    public function show(): string {
        $fee = $this->calculateFee();
        $total = $this->getAmount() + $fee;

        return "
            Pagamento com Pix: #{$this->getId()} <br>
            Descrição: {$this->getDescription()} <br>
            Chave Pix: {$this->pixKey} <br>
            Tipo da Chave: {$this->pixKeyType} <br>
            Compensação: Instantânea <br>
            Valor: R$ " . number_format($this->getAmount(), 2, ",", ".") . " <br>
            Taxa: R$ " . number_format($fee, 2, ",", ".") . " <br>
            Valor Total: R$ " . number_format($total, 2, ",", ".") . " <br>
            Status: {$this->getStatus()} <br>
        ";
    }
}
