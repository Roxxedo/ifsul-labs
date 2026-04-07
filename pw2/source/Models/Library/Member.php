<?php

namespace Source\Models\Library;

class Member {
    public int $id;
    public String $name;
    public String $email;
    public String $registrationDate;

    public function __construct(int $id, String $name, String $email, String $registrationDate) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->registrationDate = $registrationDate;
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

    public function getEmail(): String {
        return $this->email;
    }

    public function setEmail(String $email) {
        $this->email = $email;
    }

    public function getRegistrationDate(): String {
        return $this->registrationDate;
    }

    public function setRegistrationDate(String $registrationDate) {
        $this->registrationDate = $registrationDate;
    }

    public function show(): String {
        return "
        Membro: #{$this->id} - Nome: {$this->name} \n
        Email: {$this->email} \n
        Data de Registro: {$this->registrationDate} \n
        ";
    }
}