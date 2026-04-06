<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Math\PythagoreanTheorem;
use Source\Models\Math\Bhaskara;

$py1 = new PythagoreanTheorem(3, 5);
$py2 = new PythagoreanTheorem(6, 12);

$bk1 = new Bhaskara(2, 5, 6);
$bk2 = new Bhaskara(7, 4, -2);

$py1->calculate();
$py2->calculate();

$bk1->calculate();
$bk2->calculate();

echo $py1->show() . "<br>";
echo $py2->show() . "<br>";

echo $bk1->show() . "<br>";
echo $bk2->show() . "<br>";