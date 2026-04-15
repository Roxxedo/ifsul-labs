<?php

namespace source\Models\Gym;

abstract class Workout {
    protected string $memberName;
    protected string $trainerName;
    protected int $baseDuration;

    public function __construct(string $memberName, string $trainerName, int $baseDuration) {
        $this->memberName = $memberName;
        $this->trainerName = $trainerName;
        $this->baseDuration = $baseDuration;
    }

    public function getMemberName(): string {
        return $this->memberName;
    }

    public function setMemberName(string $memberName) {
        $this->memberName = $memberName;
    }

    public function getTrainerName(): string {
        return $this->trainerName;
    }

    public function setTrainerName(string $trainerName) {
        $this->trainerName = $trainerName;
    }

    public function getBaseDuration(): int {
        return $this->baseDuration;
    }

    public function setBaseDuration(int $baseDuration) {
        $this->baseDuration = $baseDuration;
    }

    abstract function calculateCalories(): float;
    abstract function estimateDuration(): int;

    public function show(): string {
        $parts = explode("\\", get_class());
        $className = end($parts);

        return "
        Treino: {$className} <br>
        Aluno: {$this->getMemberName()} | Instrutor: {$this->getTrainerName()} <br>
        Duração Base: {$this->getBaseDuration()} minutos <br>
        Calorias Queimadas: " . number_format($this->calculateCalories(), 2, ",", ".") . " kcal <br>
        Duração Total Estimada: {$this->estimateDuration()} minutos <br>
        ";
    }
}

