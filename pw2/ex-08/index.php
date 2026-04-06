<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Company\Employee;
use Source\Models\Company\Seller;
use Source\Models\Company\Manager;

$employee1 = new Employee(0, "Pedro Ambrosini", "pedroambrosini@gmail.com", "senhaforte123", "pedroambrosini.png", 75, 30);
$employee2 = new Employee(1, "Mika Giaparelli", "mikagiaparelli@gmail.com", "senhafraca123", "mikagiaparelli.png", 100, 15);

$seller1 = new Seller(0, "Maria Júlia", "mariajulia@gmail.com", "senhasmaju123", "mariajulia.png", 100, 15, 2500);
$seller2 = new Seller(1, "João Ny", "joaony@gmail.com", "joaojaojp123", "joaony.png", 100, 15, 1200);

$manager1 = new Manager(0, "Isabella Lira", "isabellalira@gmail.com", "liraloirinha", "isabellalira.png", 120, 20, 2000);
$manager2 = new Manager(1, "Carol", "carol@gmail.com", "carolsenha123", "carol.png", 100, 25, 2500);

echo "R$ " . number_format($employee1->calculateSalary(), 2) . "<br>";
echo "R$ " . number_format($employee2->calculateSalary(), 2) . "<br>";

echo "R$ " . number_format($seller1->calculateSalary(), 2) . "<br>";
echo "R$ " . number_format($seller2->calculateSalary(), 2) . "<br>";

echo "R$ " . number_format($manager1->calculateSalary(), 2) . "<br>";
echo "R$ " . number_format($manager2->calculateSalary(), 2) . "<br>";

echo "<br>";

echo $employee1->show() . "<br>";
echo $employee2->show() . "<br>";

echo $seller1->show() . "<br>";
echo $seller2->show() . "<br>";

echo $manager1->show() . "<br>";
echo $manager2->show() . "<br>";
