<?php

namespace Source\Models\Math;

class PythagoreanTheorem {
    private float $cathetusA;
    private float $cathetusB;
    private ?float $hypotenuse;

    public function __construct(float $cathetusA, float $cathetusB) {
        $this->cathetusA = $cathetusA;
        $this->cathetusB = $cathetusB;
        $this->hypotenuse = null;
    }

    public function getCathetusA() {
        return $this->cathetusA;
    }

    public function setCathetusA($cathetusA) {
        $this->cathetusA = $cathetusA;
    }

    public function getCathetusB() {
        return $this->cathetusB;
    }

    public function setCathetusB($cathetusB) {
        $this->cathetusB = $cathetusB;
    }

    public function getHypotenuse() {
        return $this->hypotenuse;
    }

    public function calculate() {
        $this->hypotenuse = sqrt(($this->getCathetusA() ** 2 + $this->getCathetusB() ** 2));
    }

    public function show() {
        return "Teorema de Pitágoras (Pythagorean Theorem) <br>
                Cateto a (Cathetus a): {$this->getCathetusA()} <br>
                Cateto b (Cathetus b): {$this->getCathetusB()} <br>
                Hipotenusa (Hypotenuse): {$this->getHypotenuse()} <br>";
    }
}