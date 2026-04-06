<?php

namespace Source\Models\Hospital;

class Patient extends User {
    private string $birthDate;
    private string $medicalRecord;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $senha = null, ?string $birthDate = null, ?string $medicalRecord = null) {
        parent::__construct($id, $name, $email, $senha);
        $this->birthDate = $birthDate;
        $this->medicalRecord = $medicalRecord;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    public function getMedicalRecord() {
        return $this->medicalRecord;
    }

    public function setMedicalRecord($medicalRecord) {
        $this->medicalRecord = $medicalRecord;
    }

    public function show() {
        return parent::show() . " - Data de Nascimento: {$this->getBirthDate()} - Prontuário: {$this->getMedicalRecord()}";
    }
}