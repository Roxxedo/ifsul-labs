<?php

namespace Source\Models\Vehicles;

use Source\Models\Vehicles\Owner;

class Vehicle {
    private string $chassisCode;
    private string $brand;
    private string $model;
    private int $year;
    private float $basePrice;
    private Owner $owner;

    public function __construct(?string $chassisCode = null, ?string $brand = null, ?string $model = null, ?int $year = null, ?float $basePrice = null, ?Owner $owner = null) {
        $this->chassisCode = $chassisCode;
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->basePrice = $basePrice;
        $this->owner = $owner;
    }

    public function getChassisCode() {
        return $this->chassisCode;
    }

    public function setChassisCode($chassisCode) {
        $this->chassisCode = $chassisCode;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getBasePrice() {
        return $this->basePrice;
    }

    public function setBasePrice($basePrice) {
        $this->basePrice = $basePrice;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
    }

    public function calculateTax(): float {
        return 0.0;
    }

    public function show(): string {
        return "
            Veículo: {$this->brand} - Modelo {$this->year} <br>
            Código de Chassi: {$this->chassisCode} <br>
            Valor Base: R$ " . number_format($this->basePrice, 2) . " <br>
            Proprietário: {$this->owner->getName()} <br>
        ";
    }
}