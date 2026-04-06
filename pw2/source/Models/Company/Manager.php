<?php

namespace Source\Models\Company;

class Manager extends Employee {
    private float $bonus;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $password = null, ?string $photo = null, ?float $hoursWorked = null, ?float $hourValue = null, ?float $bonus = null) {
        parent::__construct($id, $name, $email, $password, $photo, $hoursWorked, $hourValue);
        $this->bonus = $bonus;
    }

    public function getBonus(): float {
        return $this->bonus;
    }

    public function setBonus(float $bonus) {
        $this->bonus = $bonus;
    }

    public function calculateSalary(): float {
        return parent::calculateSalary() + $this->bonus;
    }

    public function show() {
        return "
            Gerente: #{$this->getId()} - Nome: {$this->getName()} <br>
            Email: {$this->getEmail()} <br>
            Horas Trabalhadas: " . number_format($this->getHoursWorked(), 2) . "<br>
            Valor da Hora: " . number_format($this->getHourValue(), 2) . "<br>
            Salário Base: R$ " . number_format(parent::calculateSalary(), 2) . "<br>
            Bônus Fixo: R$ " . number_format($this->bonus, 2) . "<br>
            Salário Total: R$ " . number_format($this->calculateSalary(), 2) . "<br>
        ";
    }
}