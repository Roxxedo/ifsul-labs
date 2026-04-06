<?php

namespace Source\Models\Vehicles;

use Source\Models\Vehicles\Vehicle;

class Motorcycle extends Vehicle {
    private int $displacement;

    public function __construct(?string $chassisCode = null, ?string $brand = null, ?string $model = null, ?int $year = null, ?float $basePrice = null, ?Owner $owner = null, ?int $displacement = null) {
        parent::__construct($chassisCode, $brand, $model, $year, $basePrice, $owner);
        $this->displacement = $displacement;
    }

    public function getDisplacement() {
        return $this->displacement;
    }

    public function setDisplacement($displacement) {
        $this->displacement = $displacement;
    }

    public function calculateTax(): float {
        return parent::getBasePrice() * .5;
    }

    public function show(): string {
        return "
            Motocicleta: {$this->getBrand()} - Modelo {$this->getYear()} <br>
            Código de Chassi: {$this->getChassisCode()} <br>
            Valor Base: R$ " . number_format($this->getBasePrice(), 2) . " <br>
            Cilindradas: {$this->displacement}cc <br>
            Imposto (5%): R$ " . number_format($this->calculateTax(), 2) ." <br>
            Proprietário: {$this->getOwner()->getName()} <br>
        ";
    }
}