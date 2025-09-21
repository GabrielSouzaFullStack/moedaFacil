<?php
// filepath: api/index.php

// Define o diretório base para includes
define('BASE_DIR', dirname(__DIR__));

// Carrega o autoloader
require_once BASE_DIR . '/vendor/autoload.php';

// Carrega as variáveis de ambiente
if (file_exists(BASE_DIR . '/.env')) {
  $dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
  $dotenv->load();
}

// Inclui o arquivo principal da aplicação
require_once BASE_DIR . '/public/index.php';
