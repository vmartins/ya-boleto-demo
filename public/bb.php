<?php

$banco = new \Umbrella\Ya\Boleto\Bancos\BancoBrasil\BancoBrasil("2332-9", "6166-2");
$carteira = new \Umbrella\Ya\Boleto\Bancos\BancoBrasil\Carteira\Carteira18("125");
$convenio = new \Umbrella\Ya\Boleto\Bancos\BancoBrasil\Convenio($banco, $carteira, "1643044", "1234567");

$boletoBB = new \Umbrella\Ya\Boleto\Bancos\BancoBrasil\Boleto\BancoBrasil($sacado, $cedente, $convenio);
$boletoBB->setValorDocumento(187.25)
        ->setNumeroDocumento("125")
        ->setDataVencimento(new DateTime("2013-11-08"))
        ->setInstrucoes(array(
            'Instrucao 01',
            'Instrucao 02',
            'Instrucao 03'
        ))
        ->getLinhaDigitavel();

echo $twig->render('BancoBrasil.html.twig', array(
    'model' => $boletoBB,
    'barcode' => new \Umbrella\Ya\Boleto\View\Helper\BarcodeCss()
));
