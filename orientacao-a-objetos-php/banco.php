<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Conta\Conta;

$endereco = new Endereco('Brasilia', 'um bairro', 'minha rua', '27');
$pedro = new Titular(new CPF('123.456.789-10'), 'Pedro Dias', $endereco);
$primeiraConta = new Conta($pedro, 1);
$primeiraConta->deposita(500);
$primeiraConta->saca(300);

echo $primeiraConta->getNomeTitular() . PHP_EOL;
echo $primeiraConta->getCpfTitular() . PHP_EOL;
echo $primeiraConta->getSaldo() . PHP_EOL;

$paulo = new Titular(new CPF('987.654.321-20'), 'Paulo Dias', $endereco);
$segundaConta = new Conta($paulo, 1);

var_dump($segundaConta);

// $outra = new Conta(new Titular(new CPF('123.654.789-01'), 'Outra'));
unset($segundaConta);
echo Conta::getNumeroDeContas();