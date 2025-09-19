<?php

require __DIR__ . '/../vendor/autoload.php';

// Carregar variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Inicializar o router
$router = new \App\Core\Router();

// Registrar rotas
$router->get('/', ['\App\Controllers\CotacaoController', 'mostrarCotacao']);
$router->get('/index.php', ['\App\Controllers\CotacaoController', 'mostrarCotacao']);
$router->get('/cotacoes.php', ['\App\Controllers\CotacaoController', 'mostrarMultiplasCotacoes']);
$router->get('/conversor.php', ['\App\Controllers\CotacaoController', 'mostrarConversor']);
$router->post('/conversor.php', ['\App\Controllers\CotacaoController', 'mostrarConversor']);
$router->get('/busca.php', ['\App\Controllers\CotacaoController', 'buscarMoedas']);
$router->post('/busca.php', ['\App\Controllers\CotacaoController', 'buscarMoedas']);

// Executar o router
$router->run();
