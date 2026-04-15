<?php

namespace source\Models\Gym;

class CardioWorkout extends Workout {
    private string $intensity;

    public function __construct(string $memberName, string $trainerName, int $baseDuration, string $intensity) {
        parent::__construct($memberName, $trainerName, $baseDuration);
        $this->intensity = $intensity;
    }

    public function getIntensity(): string {
        return $this->intensity;
    }

    public function setIntensity(string $intensity) {
        $this->intensity = $intensity;
    }

    public function calculateCalories(): float {
        if ($this->getIntensity() == "leve") {
            return $this->getBaseDuration() * 5;
        }
        
        if ($this->getIntensity() == "moderada") {
            return $this->getBaseDuration() * 8;
        }

        if ($this->getIntensity() == "intensa") {
            return $this->getBaseDuration() * 12;
        }

        return 0.0;
    }

    public function estimateDuration(): int {
        if ($this->getIntensity() == "leve") {
            return 30;
        }
        
        if ($this->getIntensity() == "moderada") {
            return 45;
        }

        if ($this->getIntensity() == "intensa") {
            return 60;
        }

        return 0;
    }
}
