<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Game\Character;
use Source\Models\Game\Thief;
use Source\Models\Game\Warrior;
use Source\Models\Game\Wizard;

$character = new Character("Kawazaki", 10, 2, 12);
$thief = new Thief("Kago", 12, 3, 20, 2);
$warrior = new Warrior("Krico", 13, 10, 2, 13);
$wizard = new Wizard("Estriper", 15, 12, 4, 10);

echo $character->describe() . "<br>";
echo $thief->describe() . "<br>";
echo $warrior->describe() . "<br>";
echo $wizard->describe() . "<br>";