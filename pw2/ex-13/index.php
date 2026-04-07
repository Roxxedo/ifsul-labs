<?php

require __DIR__ . "/../source/autoload.php";

use Source\Models\Banking\BankAccount;
use Source\Models\Banking\SavingsAccount;
use Source\Models\Banking\Transaction;

$account1 = new BankAccount(1, "Pedro Ambrosini", "0001-2", "1234");
$account2 = new BankAccount(2, "Maria Júlia", "0002-5", "5678");

$account1->deposit(1500, "Depósito inicial");
$account1->withdraw(300, "1234", "Saque no caixa eletrônico");
$account1->withdraw(100, "0000", "Tentativa de saque com PIN incorreto");
$account1->withdraw(-50, "1234", "Tentativa de saque com valor negativo");
$account1->withdraw(5000, "1234", "Tentativa de saque maior que o saldo");

$account2->deposit(800, "Depósito inicial");
$account1->transfer(250, "1234", $account2, "Transferência PIX");

$savingsAccount = new SavingsAccount(3, "João Ny", "0003-8", "2468", 0.5);
$savingsAccount->deposit(2000, "Depósito inicial na poupança");
$savingsAccount->applyYield();

echo "<h2>Contas</h2>";
echo $account1->show() . "<br>";
echo $account2->show() . "<br>";
echo $savingsAccount->show() . "<br>";

echo "<h2>Histórico da Conta 1</h2>";
foreach ($account1->getTransactions() as $transaction) {
    echo $transaction->show() . "<br>";
}

echo "<h2>Histórico da Conta 2</h2>";
foreach ($account2->getTransactions() as $transaction) {
    echo $transaction->show() . "<br>";
}

echo "<h2>Histórico da Poupança</h2>";
foreach ($savingsAccount->getTransactions() as $transaction) {
    echo $transaction->show() . "<br>";
}

echo "<h2>Teste de Encapsulamento</h2>";
try {
    $account1->balance = 99999;
} catch (Error $error) {
    echo "Não foi possível alterar o saldo diretamente: {$error->getMessage()}<br>";
}

echo "<br>";
echo "Saldo após tentativa de alteração direta: R$ " . number_format($account1->getBalance(), 2, ",", ".") . "<br>";