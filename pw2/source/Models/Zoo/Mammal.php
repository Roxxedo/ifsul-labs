<?php

namespace Source\Models\Zoo;

class Mammal extends Animal {
    private string $furColor;
    private int $gestationPeriod;

    public function __construct(int $id, string $name, string $species, string $habitat, float $weight, int $age, string $furColor, int $gestationPeriod) {
        parent::__construct($id, $name, $species, $habitat, $weight, $age);
        $this->furColor = $furColor;
        $this->gestationPeriod = $gestationPeriod;
    }

    public function getFurColor(): string {
        return $this->furColor;
    }

    public function setFurColor(string $furColor) {
        $this->furColor = $furColor;
    }

    public function getGestationPeriod(): int {
        return $this->gestationPeriod;
    }

    public function setGestationPeriod(int $gestationPeriod) {
        $this->gestationPeriod = $gestationPeriod;
    }

    public function breastfeed(): string {
        return "{$this->getName()} está amamentando seus filhotes.";
    }

    public function show(): string {
        return "
            Mamífero (Mammal): #{$this->getId()} - {$this->getName()} <br>
            Espécie (Species): {$this->getSpecies()} <br>
            Habitat: {$this->getHabitat()} <br>
            Peso (Weight): " . number_format($this->getWeight(), 2, ",", ".") . " kg <br>
            Idade (Age): {$this->getAge()} anos <br>
            Cor do Pelo (Fur Color): {$this->furColor} <br>
            Período de Gestação (Gestation Period): {$this->gestationPeriod} dias <br>
        ";
    }
}
