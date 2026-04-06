<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Order;

$order = new Order(0, "Pedro Ambrozine", 500.00);

echo $order->getCustomerName() . "<br>";
echo $order->getTotal() . "<br>";

echo "<br>";

$order->setCustomerName("Pedro Ambrosini");
$order->setTotal(450.00);

$order->addFee(10);

$order->show();