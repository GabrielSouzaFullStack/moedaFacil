<?php

namespace App\Core;

/**
 * Class Router
 * Responsável pelo gerenciamento de rotas da aplicação
 * @package App\Core
 */
class Router
{
  /**
   * URL base da aplicação
   * @var string
   */
  private $baseUrl;

  /**
   * Rota atual sendo processada
   * @var string
   */
  private $route;

  /**
   * Rotas registradas na aplicação
   * @var array
   */
  private $routes = [];

  /**
   * Método construtor
   */
  public function __construct()
  {
    // Detecta a URL base da aplicação
    $this->baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    // Remove a URL base para obter a rota atual
    $path = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
    $path = str_replace($this->baseUrl, '', $path);

    // Remove query string se existir
    $position = strpos($path, '?');
    if ($position !== false) {
      $path = substr($path, 0, $position);
    }

    // Define a rota atual
    $this->route = $path ?: '/';
  }

  /**
   * Registra uma rota GET
   * @param string $route
   * @param callable|array $callback
   * @return self
   */
  public function get($route, $callback)
  {
    $this->routes['GET'][$route] = $callback;
    return $this;
  }

  /**
   * Registra uma rota POST
   * @param string $route
   * @param callable|array $callback
   * @return self
   */
  public function post($route, $callback)
  {
    $this->routes['POST'][$route] = $callback;
    return $this;
  }

  /**
   * Registra uma rota para qualquer método HTTP
   * @param string $route
   * @param callable|array $callback
   * @return self
   */
  public function any($route, $callback)
  {
    $this->get($route, $callback);
    $this->post($route, $callback);
    return $this;
  }

  /**
   * Executa a rota atual
   * @return mixed
   */
  public function run()
  {
    // Método HTTP atual
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

    // Verifica se a rota existe para o método atual
    if (isset($this->routes[$method][$this->route])) {
      $callback = $this->routes[$method][$this->route];
      return $this->executeCallback($callback);
    }

    // Verifica rotas com parâmetros
    foreach ($this->routes[$method] ?? [] as $registeredRoute => $callback) {
      // Converte os parâmetros em expressão regular
      if (strpos($registeredRoute, ':') !== false) {
        $pattern = preg_replace('/:[a-zA-Z0-9]+/', '([^/]+)', $registeredRoute);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $this->route, $matches)) {
          array_shift($matches); // Remove o primeiro item (match completo)
          return $this->executeCallback($callback, $matches);
        }
      }
    }

    // Se chegou aqui, a rota não foi encontrada
    header('HTTP/1.0 404 Not Found');
    echo 'Página não encontrada';
    exit;
  }

  /**
   * Executa o callback da rota
   * @param callable|array $callback
   * @param array $params
   * @return mixed
   */
  private function executeCallback($callback, $params = [])
  {
    if (is_callable($callback)) {
      return call_user_func_array($callback, $params);
    }

    // Callback é um array [Controller, método]
    if (is_array($callback) && count($callback) === 2) {
      list($controller, $method) = $callback;

      // Se controller é uma string, instancia a classe
      if (is_string($controller)) {
        $controller = new $controller();
      }

      return call_user_func_array([$controller, $method], $params);
    }

    throw new \Exception('Callback de rota inválido');
  }

  /**
   * Redireciona para uma URL
   * @param string $url
   * @return void
   */
  public static function redirect($url)
  {
    header('Location: ' . $url);
    exit;
  }
}
