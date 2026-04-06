<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Product;

$product = new Product(0, "Morango", 10.00);

$product->setPrice(8.00);

$product->discount(5);

$product->show();
