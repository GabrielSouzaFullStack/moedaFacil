<?php

require __DIR__ . '/vendor/autoload.php';

// Carrega as variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Inclui o controlador
require __DIR__ . '/app/controllers/CotacaoController.php';

// Inclui a classe Economia para o controlador
require __DIR__ . '/app/awasomeAPI/economia.php';

// Cria uma instância do controlador
$controller = new \app\controllers\CotacaoController();

// Chama o método para mostrar o conversor
$controller->mostrarConversor();
