<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$controller = new \App\controllers\CotacaoController();
$controller->mostrarCotacao();
