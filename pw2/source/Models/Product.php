<?php

namespace Source\Models;

class Product {
    private int $id;
    private string $name;
    private float $price;

    public function __construct(int $id, ?string $name = null, ?float $price = null) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setPrice(int $price): void {
        $this->price = $price;
    }

    public function discount(int $percent): void {
        $this->price = $this->price - ($this->price * ($percent / 100));
    }

    public function show(): void {
        echo "= = = = = = = = = = <br>";
        echo "Name: $this->name <br>";
        echo "Price: R$ " . number_format($this->price, 2, ",", ".") . "<br>";
        echo "= = = = = = = = = = <br>";
    }
}