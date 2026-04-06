<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Course\Instructor;
use Source\Models\Course\Course;

$instructor01 = new Instructor(0, "Pedro", "pedro@email.com", "12345678", "Técnico", "Um programador");
$instructor02 = new Instructor(1, "Mika", "mika@email.com", "12345678", "Graduação", "Uma marketeira");

$course01 = new Course(0, "Aprenda Rust", 40, $instructor01);
$course02 = new Course(1, "Aprenda Vender", 45, $instructor02);

echo $instructor01->show() . "<br>";
echo $instructor02->show() . "<br>";

echo $course01->show() . "<br>";
echo $course02->show() . "<br>";
