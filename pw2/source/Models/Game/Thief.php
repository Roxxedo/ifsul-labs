<?php

namespace Source\Models\Game;

class Thief extends Character {
    private int $agility;

    public function __construct(string $name, int $life, int $mana, int $strength, int $agility) {
        parent::__construct($name, $life, $mana, $strength);
        $this->agility = $agility;
    }

    public function getAgility(): int {
        return $this->agility;
    }

    public function setAgility(int $agility) {
        $this->agility = $agility;
    }

    public function describe(): string {
        return parent::describe() . " | Agility: {$this->getAgility()}";
    }
}