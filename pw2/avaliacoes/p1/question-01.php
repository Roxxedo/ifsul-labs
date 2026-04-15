<?php

require __DIR__ . "/source/autoload.php";

use source\Models\Gym\Member;

// Implemente a solução da Questão 1 aqui

$m1 = new Member(1, "João Felipe", "joaofelipeazzi@gmail.com", "mensal", 100);
$m2 = new Member(2, "Pedro Ambrosini", "pedroambrosini@gmail.com", "trimestral", 100);

echo $m1->getPlan() . "<br>";
echo $m2->getPlan() . "<br>";

$m1->setPlan("trimestral");
$m2->setPlan("mensal");

echo $m1->getPlan() . "<br>";
echo $m2->getPlan() . "<br>";

echo $m1->calculateTotalCost() . "<br>";
echo $m2->calculateTotalCost() . "<br>";

echo $m1->show() . "<br>";
echo $m2->show() . "<br>";
