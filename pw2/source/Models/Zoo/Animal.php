<?php

namespace Source\Models\Zoo;

class Animal {
    private int $id;
    private string $name;
    private string $species;
    private string $habitat;
    private float $weight;
    private int $age;

    public function __construct(int $id, string $name, string $species, string $habitat, float $weight, int $age) {
        $this->id = $id;
        $this->name = $name;
        $this->species = $species;
        $this->habitat = $habitat;
        $this->weight = $weight;
        $this->age = $age;
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

    public function getSpecies(): string {
        return $this->species;
    }

    public function setSpecies(string $species) {
        $this->species = $species;
    }

    public function getHabitat(): string {
        return $this->habitat;
    }

    public function setHabitat(string $habitat) {
        $this->habitat = $habitat;
    }

    public function getWeight(): float {
        return $this->weight;
    }

    public function setWeight(float $weight) {
        $this->weight = $weight;
    }

    public function getAge(): int {
        return $this->age;
    }

    public function setAge(int $age) {
        $this->age = $age;
    }

    public function eat(): string {
        return "{$this->name} está se alimentando.";
    }

    public function sleep(): string {
        return "{$this->name} está dormindo.";
    }

    public function show(): string {
        return "
            Animal: #{$this->id} - {$this->name} <br>
            Espécie (Species): {$this->species} <br>
            Habitat: {$this->habitat} <br>
            Peso (Weight): " . number_format($this->weight, 2, ",", ".") . " kg <br>
            Idade (Age): {$this->age} anos <br>
        ";
    }
}
