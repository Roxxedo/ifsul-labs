<?php

namespace source\Models\Gym;

class Member {
    private int $id;
    private string $name;
    private string $email;
    private string $plan;
    private float $monthlyFee;

    public function __construct(int $id, string $name, string $email, string $plan, float $monthlyFee) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->plan = $plan;
        $this->monthlyFee = $monthlyFee;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPlan(): string {
        return $this->plan;
    }

    public function setPlan(string $plan) {
        $this->plan = $plan;
    }

    public function getMonthlyFee(): float {
        return $this->monthlyFee;
    }

    public function setMonthlyFee(float $monthlyFee) {
        $this->monthlyFee = $monthlyFee;
    }

    public function calculateTotalCost(): float {
        if ($this->getPlan() == "mensal") {
            return $this->getMonthlyFee();
        }
        
        if ($this->getPlan() == "trimestral") {
            return $this->getMonthlyFee() * 3 * 0.90;
        }
        
        if ($this->getPlan() == "anual") {
            return $this->getMonthlyFee() * 12 * 0.75;
        }
        
        return 0.0;
    }

    public function show(): string {
        return "
        Membro: #{$this->getId()} - {$this->getName()} <br>
        E-mail: {$this->getEmail()}} <br>
        Plano: {$this->getPlan()} <br>
        Mensalidade: R$ " . number_format($this->getMonthlyFee(), 2, ",", ".") . "<br>
        Custo Total do Plano: R$ " . number_format($this->calculateTotalCost(), 2, ",", ".") . "<br>
        ";
    }
}