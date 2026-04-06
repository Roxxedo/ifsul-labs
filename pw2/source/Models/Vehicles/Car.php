<?php

namespace Source\Models\Vehicles;

use Source\Models\Vehicles\Vehicle;

class Car extends Vehicle {
    private int $doors;
    private string $fuelType;

    public function __construct(?string $chassisCode = null, ?string $brand = null, ?string $model = null, ?int $year = null, ?float $basePrice = null, ?Owner $owner = null, ?int $doors = null, ?string $fuelType = null)
    {
        parent::__construct($chassisCode, $brand, $model, $year, $basePrice, $owner);
        $this->doors = $doors;
        $this->fuelType = $fuelType;
    }

    public function getDoors() {
        return $this->doors;
    }

    public function setDoors($doors) {
        $this->doors = $doors;
    }

    public function getFuelType() {
        return $this->fuelType;
    }

    public function setFuelType($fuelType) {
        $this->fuelType = $fuelType;
    }

    public function calculateTax(): float {
        return parent::getBasePrice() * .15;
    }

    public function show(): string {
        return "
            |C: {$this->getBrand()} - Modelo {$this->getYear()} <br>
            Código de Chassi: {$this->getChassisCode()} <br>
            Valor Base: R$ " . number_format($this->getBasePrice(), 2) . " <br>
            Portas: {$this->getDoors()} <br>
            Combustível: {$this->getFuelType()} <br>
            Imposto (15%): R$ " . number_format($this->calculateTax(), 2) . " <br>
            Proprietário: {$this->getOwner()->getName()} <br>
        ";
    }
}