<?php

namespace Source\Models\Game;

class Warrior extends Character {
    private int $defense;

    public function __construct(string $name, int $life, int $mana, int $strength, int $defense) {
        parent::__construct($name, $life, $mana, $strength);
        $this->defense = $defense;
    }

    public function getDefense(): int {
        return $this->defense;
    }

    public function setDefense(int $defense) {
        $this->defense = $defense;
    }

    public function describe(): string {
        return parent::describe() . " | Defense: {$this->getDefense()}";
    }
}