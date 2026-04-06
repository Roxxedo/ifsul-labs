<?php

namespace Source\Models;

class Order {
    private int $id;
    private string $customerName;
    private float $total;

    public function __construct(int $id, ?string $customerName = null, ?float $total = null) {
        $this->id = $id;
        $this->customerName = $customerName;
        $this->total = $total;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCustomerName(): string {
        return $this->customerName;
    }

    public function getTotal(): float {
        return $this->total;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setCustomerName(string $customerName): void {
        $this->customerName = $customerName;
    }

    public function setTotal(float $total): void {
        $this->total = $total;
    }

    public function addFee($fee): void {
        $this->total = $this->total + ($this->total * ($fee / 100));
    }

    public function show(): void {
        echo "Pedido: #$this->id - Cliente: $this->customerName - Total: " . number_format($this->total, 2, ",", ".") . "<br>";
    }
}