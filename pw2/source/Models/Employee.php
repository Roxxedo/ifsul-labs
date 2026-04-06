<?php

namespace source\Models;

class Employee {
    private int $id;
    private string $name;
    private float $salary;

    public function __construct(int $id, ?string $name, ?float $salary) {
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSalary(): float {
        return $this->salary;
    }

    public function setId(int $id) {
        return $this->id = $id;
    }

    public function setName(string $name) {
        return $this->name = $name;
    }

    public function setSalary(float $salary) {
        return $this->salary = $salary;
    }

    public function raise(int $percent) {
        $this->salary += ($this->salary * ($percent / 100));
    }

    public function show() {
        echo "Funcionário: #{$this->id} - Nome: {$this->name} - Salário: " . number_format($this->salary, 2, ",", ".");
    }
}