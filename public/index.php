<?php

use Symfony\Component\Debug\Debug;

$dirname = dirname(__DIR__);

require_once $dirname . '/vendor/autoload.php';

Debug::enable();

$banco = new \Umbrella \Ya\Boleto\Banco\BancoBrasil("1234-5", "1234567-8");
$carteira = new \Umbrella\Ya\Boleto\Carteira\Carteira187("12345678");
$convenio = new \Umbrella\Ya\Boleto\Convenio($banco, $carteira, "123456");

$pf = new \Umbrella\Ya\Boleto\PessoaFisica("Sacado 01", "09007668404");
$sacado = new \Umbrella\Ya\Boleto\Sacado($pf);
$cedente = new \Umbrella\Ya\Boleto\Cedente("Cendente 01", "92.559.708/0001-03");

$boletoBB = new \Umbrella\Ya\Boleto\Boleto\BancoBrasil($sacado, $cedente, $convenio);
$boletoBB->setValorDocumento(1000.567)
        ->setNumeroDocumento("23456")
        ->setDataVencimento(new DateTime("2013-11-02"))
        ->setInstrucoes(array(
            'Instrucao 01',
            'Instrucao 02',
            'Instrucao 03'
        ))
        ->getLinhaDigitavel();

//\Umbrella\Ya\Boleto\Debugger::dump($boleto);

$options = array(
    'cache_dir' => ''
);

$loader = new \Twig_Loader_Filesystem(array(
    $dirname . '/Resources/views'
        ));

$engine = new \Twig_Environment($loader, $options);
$engine->getExtension('core')->setNumberFormat(2, ',', '.');

echo $engine->render('BancoBrasil.html.twig', array(
    'model' => $boletoBB
));

echo $engine->render('Caixa.html.twig', array(
    'model' => $boletoBB
));