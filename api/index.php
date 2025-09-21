<?php
// filepath: api/index.php

// Mostra todos os erros para diagnóstico
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define o diretório base para includes
define('BASE_DIR', dirname(__DIR__));

// Informa o diretório base para debugging
echo "<!-- BASE_DIR: " . BASE_DIR . " -->";

// Verifica se o autoloader existe
if (file_exists(BASE_DIR . '/vendor/autoload.php')) {
  require_once BASE_DIR . '/vendor/autoload.php';
} else {
  die('Erro fatal: vendor/autoload.php não encontrado. Composer não foi executado.');
}

// Carrega manualmente a classe Router que está causando problemas
// Primeiro tenta carregar do diretório atual (api/)
if (file_exists(__DIR__ . '/Router.php')) {
  require_once __DIR__ . '/Router.php';
}
// Se não encontrar, tenta carregar do caminho padrão
else if (file_exists(BASE_DIR . '/app/core/Router.php')) {
  require_once BASE_DIR . '/app/core/Router.php';
} else {
  die('Erro fatal: Router.php não encontrado.');
}

// Carrega as variáveis de ambiente
if (file_exists(BASE_DIR . '/.env')) {
  $dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
  $dotenv->load();
}

// Inclui o arquivo principal da aplicação
require_once BASE_DIR . '/public/index.php';
