<?php

namespace Source\Models\Course;

class Instructor extends User {
    private string $degree;
    private string $bio;

    public function __construct(int $id, string $name, string $email, string $password, string $degree, string $bio) {
        parent::__construct($id, $name, $email, $password);
        $this->degree = $degree;
        $this->bio = $bio;
    }

    public function getDegree() {
        return $this->degree;
    }

    public function setDegree($degree) {
        $this->degree = $degree;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setBio($bio) {
        $this->bio = $bio;
    }

    public function show() {
        return parent::show() . " - Formação: {$this->getDegree()} - Bio: {$this->getBio()}";
    }
}