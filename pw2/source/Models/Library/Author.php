<?php

namespace Source\Models\Library;

class Author {
    private int $id;
    private String $name;
    private String $nationality;
    private int $birthYear;

    public function __construct(int $id, String $name, String $nationality, int $birthYear) {
        $this->id = $id;
        $this->name = $name;
        $this->nationality = $nationality;
        $this->birthYear = $birthYear;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName(): String {
        return $this->name;
    }

    public function setName(String $name) {
        $this->name = $name;
    }

    public function getNationality(): String {
        return $this->nationality;
    }

    public function setNationality(String $nationality) {
        $this->nationality = $nationality;
    }

    public function getBirthYear(): String {
        return $this->birthYear;
    }

    public function setBirthYear(String $birthYear) {
        $this->birthYear = $birthYear;
    }

    public function show(): String {
        return "
        Autor: {$this->name} \n
        Nacionalidade: {$this->nationality} \n
        Ano de Nascimento: {$this->birthYear} \n
        ";
    }
}