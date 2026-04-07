<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Payment\CreditCardPayment;
use Source\Models\Payment\PixPayment;
use Source\Models\Payment\BoletoPayment;

$creditCard1 = new CreditCardPayment(1, 250, "Compra Online", "4321", 3, 2.5);
$creditCard2 = new CreditCardPayment(2, 1200, "Notebook", "9876", 10, 3.2);

$pix1 = new PixPayment(3, 150, "Pedido por Pix", "email@exemplo.com", "email");
$pix2 = new PixPayment(4, 89.90, "Assinatura Mensal", "11999999999", "telefone");

$boleto = new BoletoPayment(5, 250, "Compra no Boleto", "23793.38128 60007.827136 95000.063305 1 98760000025000", "2026-04-10", 3.50);

$creditCard2->setInstallments(12);
$pix2->setPixKeyType("telefone");
$boleto->setDueDate("2026-04-12");

$payments = [$creditCard1, $creditCard2, $pix1, $pix2, $boleto];

echo "<h2>Processamento dos Pagamentos</h2>";
foreach ($payments as $payment) {
    echo $payment->process() . "<br>";
    echo "Taxa calculada: R$ " . number_format($payment->calculateFee(), 2, ",", ".") . "<br>";
    echo $payment->show() . "<br>";
}
