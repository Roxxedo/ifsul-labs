<?php

namespace Source\Models\Company;

use Source\Models\User;

class Employee extends User {
    private float $hoursWorked;
    private float $hourValue;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $password = null, ?string $photo = null, ?float $hoursWorked = null, ?float $hourValue = null) {
        parent::__construct($id, $name, $email, $password, $photo);
        $this->hoursWorked = $hoursWorked;
        $this->hourValue = $hourValue;
    }

    public function getHoursWorked(): float {
        return $this->hoursWorked;
    }

    public function setHoursWorked(float $hoursWorked) {
        $this->hoursWorked = $hoursWorked;
    }

    public function getHourValue(): float {
        return $this->hourValue;
    }

    public function setHourValue(float $hourValue) {
        $this->hourValue = $hourValue;
    }

    public function calculateSalary(): float {
        return $this->hoursWorked * $this->hourValue;
    }

    public function show() {
        return "
            Funcionário: #{$this->getId()} - Nome: {$this->getName()} <br>
            Email: {$this->getEmail()} <br>
            Horas Trabalhadas: " . number_format($this->getHoursWorked(), 2) . "<br>
            Valor da Hora: " . number_format($this->getHourValue(), 2) . "<br>
            Salário: R$ " . number_format($this->calculateSalary(), 2) . "<br>
        ";
    }
}