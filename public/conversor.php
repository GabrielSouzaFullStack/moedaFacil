<?php
// Redirecionar para o router principal
require_once __DIR__ . '/index.php';
require __DIR__ . '/app/awasomeAPI/economia.php';

// Cria uma instância do controlador
$controller = new \app\controllers\CotacaoController();

// Chama o método para mostrar o conversor
$controller->mostrarConversor();
