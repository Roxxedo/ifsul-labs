<?php

require __DIR__ . "/source/autoload.php";

use source\Models\Gym\CardioWorkout;
use source\Models\Gym\StrengthWorkout;

// Implemente a solução da Questão 2 aqui
$cw1 = new CardioWorkout("Pedro Ambrosini", "Gabriel Saraiva", 10, "moderada");
$cw2 = new CardioWorkout("Enzo Gabriel", "João Felipe", 5, "leve");

$sw1 = new StrengthWorkout("Pedro Ambrosini", "Gabriel Saraiva", 10, "completo");
$sw2 = new StrengthWorkout("Enzo Gabriel", "João Felipe", 5, "inferior");

$cw1->getMemberName() . "<br>";
$cw2->getMemberName() . "<br>";

$sw1->getMemberName() . "<br>";
$sw2->getMemberName() . "<br>";

$cw1->setBaseDuration(15);
$cw2->setBaseDuration(3);

$sw1->setBaseDuration(15);
$sw2->setBaseDuration(15);

echo $cw1->show() . "<br>";
echo $cw2->show() . "<br>";

echo $sw1->show() . "<br>";
echo $sw2->show() . "<br>";