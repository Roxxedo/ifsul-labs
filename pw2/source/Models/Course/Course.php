<?php

namespace Source\Models\Course;

class Course {
    private int $id;
    private string $title;
    private int $hours;
    private Instructor $instructor;

    public function __construct(int $id, string $title, int $hours, Instructor $instructor) {
        $this->id = $id;
        $this->title = $title;
        $this->hours = $hours;
        $this->instructor = $instructor;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getHours() {
        return $this->hours;
    }

    public function setHours($hours) {
        $this->hours = $hours;
    }

    public function getInstructor() {
        return $this->instructor;
    }

    public function setInstructor($instructor) {
        $this->instructor = $instructor;
    }

    public function show() {
        return "Curso: #{$this->getId()} - Título: {$this->getTitle()} - Carga Horária: {$this->getHours()}h - Instrutor: {$this->getInstructor()->getName()}";
    }
}