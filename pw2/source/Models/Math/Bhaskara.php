<?php

namespace Source\Models\Math;

class Bhaskara {
    private float $a;
    private float $b;
    private float $c;
    private float $discriminant;
    private ?float $root1;
    private ?float $root2;

    public function __construct(float $a, float $b, float $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getA() {
        return $this->a;
    }

    public function setA($a) {
        $this->a = $a;
    }

    public function getB() {
        return $this->b;
    }

    public function setB($b) {
        $this->b = $b;
    }

    public function getC() {
        return $this->c;
    }

    public function setC($c) {
        $this->c = $c;
    }

    public function calculate() {
        $this->discriminant = ($this->b ** 2 - 4 * $this->a * $this->c);

        if ($this->discriminant < 0) {
            $this->root1 = null;
            $this->root2 = null;
            return;
        }

        if ($this->discriminant == 0) {
            $x = (-$this->b + sqrt($this->discriminant)) / 2 * $this->a;
            $this->root1 = $x;
            $this->root2 = $x;
            return;
        }

        if ($this->discriminant > 0) {
            $this->root1 = (-$this->b + sqrt($this->discriminant)) / 2 * $this->a;
            $this->root2 = (-$this->b - sqrt($this->discriminant)) / 2 * $this->a;
            return;
        }
    }

    public function show() {
        if ($this->discriminant < 0) {
            return "Fórmula de Báskara (Bhaskara's Formula) <br>
                    Coeficiente a (Coefficient a): {$this->a} <br>
                    Coeficiente b (Coefficient b): {$this->b} <br>
                    Coeficiente c (Coefficient c): {$this->c} <br>
                    Discriminante (Discriminant) Δ: {$this->discriminant} <br>
                    ** Não existem raízes reais ** <br>";
        } else {
            return "Fórmula de Báskara (Bhaskara's Formula) <br>
                    Coeficiente a (Coefficient a): {$this->a} <br>
                    Coeficiente b (Coefficient b): {$this->b} <br>
                    Coeficiente c (Coefficient c): {$this->c} <br>
                    Discriminante (Discriminant) Δ: {$this->discriminant} <br>
                    Raiz 1 (Root 1) x₁: {$this->root1} <br>
                    Raiz 2 (Root 2) x₂: {$this->root2} <br>";
        }
    }
}