<?php

namespace Source\Models\Game;

class Character {
    private string $name;
    private int $life;
    private int $mana;
    private int $strength;

    public function __construct(string $name, int $life, int $mana, int $strength) {
        $this->name = $name;
        $this->life = $life;
        $this->mana = $mana;
        $this->strength = $strength;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getLife(): int {
        return $this->life;
    }

    public function getMana(): int {
        return $this->mana;
    }

    public function getStrength(): int {
        return $this->strength;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setLife(int $life) {
        $this->life = $life;
    }

    public function setMana(int $mana) {
        $this->mana = $mana;
    }

    public function setStrength(int $strength) {
        $this->strength = $strength;
    }

    public function describe(): string {
        return "Name: {$this->getName()} | Life: {$this->getLife()} | Mana: {$this->getMana()} | Strength: {$this->getStrength()}";
    }
}