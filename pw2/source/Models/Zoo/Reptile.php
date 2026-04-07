<?php

namespace Source\Models\Zoo;

class Reptile extends Animal {
    private bool $isVenomous;
    private string $scaleType;

    public function __construct(int $id, string $name, string $species, string $habitat, float $weight, int $age, bool $isVenomous, string $scaleType) {
        parent::__construct($id, $name, $species, $habitat, $weight, $age);
        $this->isVenomous = $isVenomous;
        $this->scaleType = $scaleType;
    }

    public function getIsVenomous(): bool {
        return $this->isVenomous;
    }

    public function setIsVenomous(bool $isVenomous) {
        $this->isVenomous = $isVenomous;
    }

    public function getScaleType(): string {
        return $this->scaleType;
    }

    public function setScaleType(string $scaleType) {
        $this->scaleType = $scaleType;
    }

    public function shed(): string {
        return "{$this->getName()} está trocando de pele (shedding).";
    }

    public function show(): string {
        $isVenomous = $this->isVenomous ? "Sim" : "Não";

        return "
            Réptil (Reptile): #{$this->getId()} - {$this->getName()} <br>
            Espécie (Species): {$this->getSpecies()} <br>
            Habitat: {$this->getHabitat()} <br>
            Peso (Weight): " . number_format($this->getWeight(), 2, ",", ".") . " kg <br>
            Idade (Age): {$this->getAge()} anos <br>
            Venenoso (Venomous): {$isVenomous} <br>
            Tipo de Escamas (Scale Type): {$this->scaleType} <br>
        ";
    }
}
