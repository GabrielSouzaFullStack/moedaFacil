<?php
// filepath: public/index.php

// Define constantes para caminhos se ainda não foram definidas
if (!defined('BASE_DIR')) {
  define('BASE_DIR', dirname(__DIR__));
}

// Carrega o autoloader se ainda não foi carregado
if (!class_exists('Dotenv\Dotenv')) {
  require_once BASE_DIR . '/vendor/autoload.php';
}

// Carrega as variáveis de ambiente se ainda não foram carregadas
if (!isset($_ENV['API_BASE_URL']) && file_exists(BASE_DIR . '/.env')) {
  $dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
  $dotenv->load();
}

use App\Core\Router;
use App\Controllers\CotacaoController;

// Instancia o router
$router = new Router();

// Define as rotas
$router->get('/', ['App\Controllers\CotacaoController', 'mostrarCotacao']);
$router->get('/index.php', ['App\Controllers\CotacaoController', 'mostrarCotacao']);
$router->any('/cotacoes.php', ['App\Controllers\CotacaoController', 'mostrarMultiplasCotacoes']);
$router->any('/conversor.php', ['App\Controllers\CotacaoController', 'mostrarConversor']);
$router->any('/busca.php', ['App\Controllers\CotacaoController', 'buscarMoedas']);

// Executa o router
$router->run();
