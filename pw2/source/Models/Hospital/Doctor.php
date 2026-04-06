<?php

namespace Source\Models\Hospital;

class Doctor extends User {
    private string $crm;
    private string $speciality;

    public function __construct(int $id, ?string $name = null, ?string $email = null, ?string $senha = null, ?string $crm = null, ?string $speciality = null) {
        parent::__construct($id, $name, $email, $senha);
        $this->crm = $crm;
        $this->speciality = $speciality;
    }

    public function getCrm() {
        return $this->crm;
    }

    public function setCrm($crm) {
        $this->crm = $crm;
    }

    public function getSpeciality() {
        return $this->speciality;
    }

    public function setSpeciality($speciality) {
        $this->speciality = $speciality;
    }

    public function show() {
        return parent::show() . " - CRM: {$this->getCrm()} - Especialidade: {$this->getSpeciality()}";
    }
}