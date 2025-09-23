<?php

namespace App\Core;

/**
 * Class Controller
 * Classe base para todos os controllers da aplicação
 * @package App\Core
 */
abstract class Controller
{
  /**
   * Método para renderizar uma view
   * @param string $view Nome do arquivo de view
   * @param array $data Dados para passar para a view
   * @return void
   */
  protected function render($view, $data = [])
  {
    // Extrai as variáveis para o escopo da view
    extract($data);

    // Caminho para o arquivo de view
    $viewPath = __DIR__ . '/../views/' . $view . '.php';

    // Verifica se o arquivo existe
    if (!file_exists($viewPath)) {
      throw new \Exception('View não encontrada: ' . $view);
    }

    // Inicia o buffer de saída
    ob_start();

    // Inclui o arquivo de view
    include $viewPath;

    // Captura o conteúdo do buffer e limpa
    $content = ob_get_clean();

    // Exibe o conteúdo
    echo $content;
  }

  /**
   * Método para retornar dados em formato JSON
   * @param mixed $data
   * @param int $statusCode
   * @return void
   */
  protected function json($data, $statusCode = 200)
  {
    // Define o tipo de conteúdo
    header('Content-Type: application/json');

    // Define o código de status HTTP
    http_response_code($statusCode);

    // Codifica e exibe os dados em JSON
    echo json_encode($data);
    exit;
  }
}
