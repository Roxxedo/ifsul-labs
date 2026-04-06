<?php

namespace Source\Models\Game;

class Wizard extends Character {
    private int $intelligence;

    public function __construct(string $name, int $life, int $mana, int $strength, int $intelligence) {
        parent::__construct($name, $life, $mana, $strength);
        $this->intelligence = $intelligence;
    }

    public function getIntelligence(): int {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence) {
        $this->intelligence = $intelligence;
    }

    public function describe(): string {
        return parent::describe() . " | Intelligence: {$this->getIntelligence()}";
    }
}