<?php

namespace source\Models\Gym;

class StrengthWorkout extends Workout {
    private string $muscleGroup;

    public function __construct(string $memberName, string $trainerName, int $baseDuration, string $muscleGroup) {
        parent::__construct($memberName, $trainerName, $baseDuration);
        $this->muscleGroup = $muscleGroup;
    }

    public function getMuscleGroup(): string {
        return $this->muscleGroup;
    }

    public function setMuscleGroup(string $muscleGroup) {
        $this->muscleGroup = $muscleGroup;
    }

    public function calculateCalories(): float {
        if ($this->getMuscleGroup() == "superior") {
            return $this->getBaseDuration() * 6;
        }

        if ($this->getMuscleGroup() == "inferior") {
            return $this->getBaseDuration() * 7;
        }

        if ($this->getMuscleGroup() == "completo") {
            return $this->getBaseDuration() * 10;
        }

        return 0.0;
    }

    public function estimateDuration(): int {
        if ($this->getMuscleGroup() == "superior") {
            return 45;
        }

        if ($this->getMuscleGroup() == "inferior") {
            return 50;
        }

        if ($this->getMuscleGroup() == "completo") {
            return 75;
        }

        return 0.0;
    }
}
