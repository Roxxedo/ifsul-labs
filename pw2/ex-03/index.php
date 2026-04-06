<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Employee;

$employee = new Employee(1, "Pedro Ambrozine", 5453.0);

echo $employee->getName() . "<br>";
echo $employee->getSalary() . "<br>";

$employee->setName("Pedro Ambrosini");
$employee->setSalary(6000.0);

$employee->raise(25);

$employee->show();