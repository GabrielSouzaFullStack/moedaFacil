<?php
// debug.php - Para ser colocado na pasta raiz da Vercel (mesmo nível que api/index.php)
header('Content-Type: text/plain');

echo "========== DIAGNÓSTICO DE AMBIENTE VERCEL ==========\n\n";

// Informações básicas
echo "DATA E HORA: " . date('Y-m-d H:i:s') . "\n";
echo "PHP VERSION: " . phpversion() . "\n";
echo "MEMORY LIMIT: " . ini_get('memory_limit') . "\n\n";

// Variáveis de ambiente
echo "========== VARIÁVEIS DE AMBIENTE ==========\n";
echo "VERCEL: " . (isset($_ENV['VERCEL']) ? $_ENV['VERCEL'] : 'não definido') . "\n";
echo "VERCEL_ENV: " . (isset($_ENV['VERCEL_ENV']) ? $_ENV['VERCEL_ENV'] : 'não definido') . "\n";
echo "API_BASE_URL: " . (isset($_ENV['API_BASE_URL']) ? $_ENV['API_BASE_URL'] : 'não definido') . "\n\n";

// Estrutura de arquivos
echo "========== ESTRUTURA DE ARQUIVOS ==========\n";
echo "DIRETÓRIO ATUAL: " . __DIR__ . "\n";
echo "DIRETÓRIO BASE: " . dirname(__DIR__) . "\n\n";

// Verifica se os diretórios importantes existem
echo "API DIR EXISTS: " . (is_dir(__DIR__ . '/api') ? 'SIM' : 'NÃO') . "\n";
echo "APP DIR EXISTS: " . (is_dir(__DIR__ . '/app') ? 'SIM' : 'NÃO') . "\n";
echo "VENDOR DIR EXISTS: " . (is_dir(__DIR__ . '/vendor') ? 'SIM' : 'NÃO') . "\n";

// Lista arquivos em diretórios importantes
if (is_dir(__DIR__ . '/app')) {
  echo "\nARQUIVOS EM /app:\n";
  $files = scandir(__DIR__ . '/app');
  echo implode(", ", $files) . "\n";

  // Verifica a pasta app/core
  if (is_dir(__DIR__ . '/app/core')) {
    echo "\nARQUIVOS EM /app/core:\n";
    $files = scandir(__DIR__ . '/app/core');
    echo implode(", ", $files) . "\n";

    // Verifica se o Router.php existe
    echo "\nROUTER.PHP EXISTS: " . (file_exists(__DIR__ . '/app/core/Router.php') ? 'SIM' : 'NÃO') . "\n";

    if (file_exists(__DIR__ . '/app/core/Router.php')) {
      echo "ROUTER.PHP SIZE: " . filesize(__DIR__ . '/app/core/Router.php') . " bytes\n";
      echo "ROUTER.PHP CONTENT SAMPLE: \n";
      echo substr(file_get_contents(__DIR__ . '/app/core/Router.php'), 0, 100) . "...\n";
    }
  } else {
    echo "\nPASTA /app/core NÃO EXISTE!\n";
  }
}

// Verifica o autoloader
echo "\n========== AUTOLOADER ==========\n";
echo "VENDOR/AUTOLOAD.PHP EXISTS: " . (file_exists(__DIR__ . '/vendor/autoload.php') ? 'SIM' : 'NÃO') . "\n";

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  echo "ATTEMPTING TO INCLUDE AUTOLOADER...\n";
  try {
    require_once __DIR__ . '/vendor/autoload.php';
    echo "AUTOLOADER INCLUDED SUCCESSFULLY!\n";
  } catch (Exception $e) {
    echo "ERROR INCLUDING AUTOLOADER: " . $e->getMessage() . "\n";
  }

  // Tenta carregar a classe Router
  echo "\nCHECKING FOR Router CLASS...\n";
  echo "CLASS_EXISTS App\\Core\\Router: " . (class_exists('App\\Core\\Router') ? 'SIM' : 'NÃO') . "\n";
}

// Informações de erro
echo "\n========== CONFIGURAÇÃO DE ERROS ==========\n";
echo "display_errors: " . ini_get('display_errors') . "\n";
echo "error_reporting: " . ini_get('error_reporting') . "\n";

// Informações sobre extensões
echo "\n========== EXTENSÕES PHP CARREGADAS ==========\n";
$extensions = get_loaded_extensions();
echo implode(", ", $extensions) . "\n";

echo "\n========== FIM DO DIAGNÓSTICO ==========\n";
