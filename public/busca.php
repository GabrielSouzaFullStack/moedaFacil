<?php
// Redirecionar para o router principal
require_once __DIR__ . '/index.php';

// Inclui a classe Economia para o controlador
require __DIR__ . '/app/awasomeAPI/economia.php';

// Cria uma instância do controlador
$controller = new \app\controllers\CotacaoController();

// Chama o método para buscar moedas
$controller->buscarMoedas();
