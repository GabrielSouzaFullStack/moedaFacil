<?php
// Mostra todos os erros para diagnóstico
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Diagnóstico do Ambiente Vercel</h1>";

// Define o diretório base para includes
define('BASE_DIR', dirname(__DIR__));
echo "<p>BASE_DIR: " . BASE_DIR . "</p>";

// Listagem de arquivos no diretório atual
echo "<h2>Arquivos no diretório atual:</h2>";
echo "<pre>";
print_r(scandir(__DIR__));
echo "</pre>";

// Listagem de arquivos no diretório raiz
echo "<h2>Arquivos no diretório raiz:</h2>";
echo "<pre>";
print_r(scandir(BASE_DIR));
echo "</pre>";

// Verifica se o vendor existe
$vendorPath = BASE_DIR . '/vendor';
echo "<h2>Verifica diretório vendor:</h2>";
echo "Caminho: $vendorPath<br>";
if (file_exists($vendorPath) && is_dir($vendorPath)) {
  echo "✓ vendor/ existe<br>";
  echo "<pre>";
  print_r(scandir($vendorPath));
  echo "</pre>";
} else {
  echo "✗ vendor/ não existe<br>";
}

// Verifica se o autoloader existe
$autoloaderPath = $vendorPath . '/autoload.php';
echo "<h2>Verifica autoloader:</h2>";
echo "Caminho: $autoloaderPath<br>";
if (file_exists($autoloaderPath)) {
  echo "✓ autoloader encontrado<br>";

  // Carrega o autoloader
  require_once $autoloaderPath;
  echo "✓ autoloader carregado<br>";
} else {
  echo "✗ autoloader não encontrado<br>";
}

// Verifica a estrutura da aplicação
$appPath = BASE_DIR . '/app';
echo "<h2>Verifica estrutura da aplicação:</h2>";
echo "Caminho: $appPath<br>";
if (file_exists($appPath) && is_dir($appPath)) {
  echo "✓ app/ existe<br>";
  echo "<pre>";
  print_r(scandir($appPath));
  echo "</pre>";

  // Verifica o diretório core
  $corePath = $appPath . '/core';
  echo "Caminho core: $corePath<br>";
  if (file_exists($corePath) && is_dir($corePath)) {
    echo "✓ app/core/ existe<br>";
    echo "<pre>";
    print_r(scandir($corePath));
    echo "</pre>";

    // Verifica o arquivo Router.php
    $routerPath = $corePath . '/Router.php';
    echo "Caminho Router: $routerPath<br>";
    if (file_exists($routerPath)) {
      echo "✓ Router.php encontrado<br>";
      echo "<h3>Conteúdo do Router.php:</h3>";
      echo "<pre>" . htmlspecialchars(file_get_contents($routerPath)) . "</pre>";

      // Tenta carregar o Router manualmente
      require_once $routerPath;
      echo "✓ Router.php carregado manualmente<br>";

      // Verifica se a classe existe após carregamento manual
      if (class_exists('App\\Core\\Router')) {
        echo "✓ Classe App\\Core\\Router existe após carregamento manual<br>";
      } else {
        echo "✗ Classe App\\Core\\Router não existe mesmo após carregamento manual<br>";
      }
    } else {
      echo "✗ Router.php não encontrado<br>";
    }
  } else {
    echo "✗ app/core/ não existe<br>";
  }
} else {
  echo "✗ app/ não existe<br>";
}

// Verifica a configuração do composer
$composerJsonPath = BASE_DIR . '/composer.json';
echo "<h2>Verifica composer.json:</h2>";
echo "Caminho: $composerJsonPath<br>";
if (file_exists($composerJsonPath)) {
  echo "✓ composer.json encontrado<br>";
  $composerJson = json_decode(file_get_contents($composerJsonPath), true);
  echo "<h3>Conteúdo do composer.json:</h3>";
  echo "<pre>" . json_encode($composerJson, JSON_PRETTY_PRINT) . "</pre>";

  // Verifica a configuração de autoload
  if (isset($composerJson['autoload'])) {
    echo "✓ Configuração de autoload encontrada<br>";
    echo "<pre>" . json_encode($composerJson['autoload'], JSON_PRETTY_PRINT) . "</pre>";
  } else {
    echo "✗ Configuração de autoload não encontrada<br>";
  }
} else {
  echo "✗ composer.json não encontrado<br>";
}

// Exibe as classes disponíveis
echo "<h2>Classes declaradas:</h2>";
echo "<pre>";
print_r(get_declared_classes());
echo "</pre>";

// Tenta instanciar a classe Router
echo "<h2>Teste de instanciação da classe Router:</h2>";
try {
  $router = new App\Core\Router();
  echo "✓ Router instanciado com sucesso<br>";
} catch (Throwable $e) {
  echo "✗ Erro ao instanciar Router: " . $e->getMessage() . "<br>";
  echo "Arquivo: " . $e->getFile() . "<br>";
  echo "Linha: " . $e->getLine() . "<br>";
  echo "Trace:<br>";
  echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

// Informações sobre o ambiente PHP
echo "<h2>Informações do ambiente PHP:</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Extensões carregadas:</p>";
echo "<pre>";
print_r(get_loaded_extensions());
echo "</pre>";

// Exibe todas as variáveis de ambiente
echo "<h2>Variáveis de ambiente:</h2>";
echo "<pre>";
print_r($_ENV);
echo "</pre>";

// Exibe o include_path
echo "<h2>Include Path:</h2>";
echo "<pre>" . get_include_path() . "</pre>";

// Exibe todos os arquivos incluídos
echo "<h2>Arquivos incluídos:</h2>";
echo "<pre>";
print_r(get_included_files());
echo "</pre>";
