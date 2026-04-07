<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Zoo\Animal;
use Source\Models\Zoo\Mammal;
use Source\Models\Zoo\Bird;
use Source\Models\Zoo\Reptile;

$lion = new Mammal(1, "Simba", "Panthera leo", "Savana", 190, 5, "Dourado", 110);
$dolphin = new Mammal(2, "Flipper", "Tursiops truncatus", "Oceano", 150, 8, "Cinza", 365);

$macaw = new Bird(3, "Blu", "Spix's Macaw", "Floresta Tropical", 0.30, 3, 40, true);
$penguin = new Bird(4, "Pingo", "Aptenodytes forsteri", "Antártida", 25, 6, 75, false);

$snake = new Reptile(5, "Rex", "Boa constrictor", "Floresta Amazônica", 12, 8, false, "Lisas");

$lion->setWeight(195);
$dolphin->setHabitat("Oceano Atlântico");
$macaw->setAge(4);
$penguin->setWingspan(76);
$snake->setScaleType("Lisas e brilhantes");

echo "<h2>Comportamentos dos Mamíferos</h2>";
echo $lion->eat() . "<br>";
echo $lion->sleep() . "<br>";
echo $lion->breastfeed() . "<br><br>";

echo $dolphin->eat() . "<br>";
echo $dolphin->sleep() . "<br>";
echo $dolphin->breastfeed() . "<br><br>";

echo "<h2>Comportamentos das Aves</h2>";
echo $macaw->eat() . "<br>";
echo $macaw->sing() . "<br>";
echo $macaw->fly() . "<br><br>";

echo $penguin->eat() . "<br>";
echo $penguin->sing() . "<br>";
echo $penguin->fly() . "<br><br>";

echo "<h2>Comportamentos dos Répteis</h2>";
echo $snake->eat() . "<br>";
echo $snake->sleep() . "<br>";
echo $snake->shed() . "<br><br>";

echo "<h2>Consulta com Getters</h2>";
echo "Animal consultado: {$lion->getName()} - {$lion->getSpecies()}<br>";
echo "Habitat atualizado do golfinho: {$dolphin->getHabitat()}<br>";
echo "Envergadura atualizada do pinguim: " . number_format($penguin->getWingspan(), 2, ",", ".") . " cm<br><br>";

echo "<h2>Dados dos Animais</h2>";
echo $lion->show() . "<br>";
echo $dolphin->show() . "<br>";
echo $macaw->show() . "<br>";
echo $penguin->show() . "<br>";
echo $snake->show() . "<br>";
