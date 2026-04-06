<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Faq\Type;
use Source\Models\Faq\Question;

$type1 = new Type(1, "Incrições");
$type2 = new Type(2, "Sobre o Evento");

$question1 = new Question(1, "Como me inscrevo?", "Se inscrevendo", $type1);
$question2 = new Question(2, "Como é o evento?", "Bem legal", $type2);

echo $question1->getType()->getName() . "<br>";
echo $question1->getQuestion() . "<br>";

echo $question2->getType()->getName() . "<br>";
echo $question2->getQuestion() . "<br>";

echo "<br>";

$question1->setQuestion("Como faço para me inscrever no evento?");
$question2->setQuestion("Como funciona o evento? É legal?");

$question1->show();

echo "<br>";

$question2->show();