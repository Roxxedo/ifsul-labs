<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Hospital\Patient;
use Source\Models\Hospital\Doctor;

$patient01 = new Patient(0, "Pedro", "pedro@email.com", "12345678", "17/12/2007", "TDAH");
$patient02 = new Patient(1, "Mika", "mika@email.com", "12345678", "24/05/2005", "Haters");

$doctor01 = new Doctor(3, "Jorge", "jorge@email.com", "12345678", "123456", "Cardiologista");
$doctor02 = new Doctor(4, "Cleber", "cleber@email.com", "12345678", "789012", "Clínico Geral");

$patient01->setSenha("jfopnaiojdn");
$patient02->setSenha("dmaopnda");

$doctor01->setCrm("372846");
$doctor02->setCrm("492374");

echo $patient01->show() . "<br>";
echo $patient02->show() . "<br>";

echo $doctor01->show() . "<br>";
echo $doctor02->show() . "<br>";