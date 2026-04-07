<?php

namespace Source\Models\Zoo;

class Bird extends Animal {
    private float $wingspan;
    private bool $canFly;

    public function __construct(int $id, string $name, string $species, string $habitat, float $weight, int $age, float $wingspan, bool $canFly) {
        parent::__construct($id, $name, $species, $habitat, $weight, $age);
        $this->wingspan = $wingspan;
        $this->canFly = $canFly;
    }

    public function getWingspan(): float {
        return $this->wingspan;
    }

    public function setWingspan(float $wingspan) {
        $this->wingspan = $wingspan;
    }

    public function getCanFly(): bool {
        return $this->canFly;
    }

    public function setCanFly(bool $canFly) {
        $this->canFly = $canFly;
    }

    public function sing(): string {
        return "{$this->getName()} está cantando.";
    }

    public function fly(): string {
        if ($this->canFly) {
            return "{$this->getName()} está voando!";
        }

        return "{$this->getName()} não consegue voar.";
    }

    public function show(): string {
        $canFly = $this->canFly ? "Sim" : "Não";

        return "
            Ave (Bird): #{$this->getId()} - {$this->getName()} <br>
            Espécie (Species): {$this->getSpecies()} <br>
            Habitat: {$this->getHabitat()} <br>
            Peso (Weight): " . number_format($this->getWeight(), 2, ",", ".") . " kg <br>
            Idade (Age): {$this->getAge()} anos <br>
            Envergadura (Wingspan): " . number_format($this->wingspan, 2, ",", ".") . " cm <br>
            Voa (Can Fly): {$canFly} <br>
        ";
    }
}
