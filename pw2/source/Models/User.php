<?php

namespace Source\Models;

class User {
    private int $id;
    private ?string $name;
    private ?string $email;
    private ?string $password;
    private ?string $photo;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $password = null, ?string $photo = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->photo = $photo;
    }

    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto(string $photo) {
        $this->photo = $photo;
    }
}