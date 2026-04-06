<?php

namespace Source\Models\Company;

class Seller extends Employee {
    private float $totalSales;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $password = null, ?string $photo = null, ?float $hoursWorked = null, ?float $hourValue = null, ?float $totalSales = null) {
        parent::__construct($id, $name, $email, $password, $photo, $hoursWorked, $hourValue);
        $this->totalSales = $totalSales;
    }

    public function getTotalSales(): float {
        return $this->totalSales;
    }

    public function setTotalSales(float $totalSales) {
        $this->totalSales = $totalSales;
    }

    public function calculateCommission(): float {
        return $this->totalSales * .10;
    }

    public function calculateSalary(): float {
        return parent::calculateSalary() + $this->calculateCommission();
    }

    public function show() {
        return "
            Vendedor: #{$this->getId()} - Nome: {$this->getName()} <br>
            Email: {$this->getEmail()} <br>
            Horas Trabalhadas: " . number_format($this->getHoursWorked(), 2) . "<br>
            Valor da Hora: " . number_format($this->getHourValue(), 2) . "<br>
            Salário Base: R$ " . number_format(parent::calculateSalary(), 2) . "<br>
            Total de Vendas: R$ " . number_format($this->getTotalSales(), 2) . "<br>
            Comissão (10%): R$" . number_format($this->calculateCommission(), 2) . "<br>
            Salário Total: R$" . number_format($this->calculateSalary(), 2) . "<br>
        ";
    }
}