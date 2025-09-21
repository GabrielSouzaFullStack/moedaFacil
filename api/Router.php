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
    // Detecta se está na Vercel ou localhost
    $isVercel = isset($_ENV['VERCEL']) || isset($_ENV['VERCEL_ENV']);
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';

    if ($isVercel) {
      $this->baseUrl = 'https://' . $host;
    } else {
      $this->baseUrl = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $host;
    }

    $this->route = $_SERVER['REQUEST_URI'] ?? '/';

    // Remove query string
    if (($pos = strpos($this->route, '?')) !== false) {
      $this->route = substr($this->route, 0, $pos);
    }

    // Remove trailing slash
    if ($this->route != '/' && substr($this->route, -1) == '/') {
      $this->route = rtrim($this->route, '/');
    }
  }

  /**
   * Adiciona uma nova rota para o método GET
   * @param string $route
   * @param array|callable $action
   */
  public function get($route, $action)
  {
    $this->addRoute('GET', $route, $action);
  }

  /**
   * Adiciona uma nova rota para o método POST
   * @param string $route
   * @param array|callable $action
   */
  public function post($route, $action)
  {
    $this->addRoute('POST', $route, $action);
  }

  /**
   * Adiciona uma nova rota para o método PUT
   * @param string $route
   * @param array|callable $action
   */
  public function put($route, $action)
  {
    $this->addRoute('PUT', $route, $action);
  }

  /**
   * Adiciona uma nova rota para o método DELETE
   * @param string $route
   * @param array|callable $action
   */
  public function delete($route, $action)
  {
    $this->addRoute('DELETE', $route, $action);
  }

  /**
   * Adiciona uma rota para qualquer método HTTP
   * @param string $route
   * @param array|callable $action
   */
  public function any($route, $action)
  {
    $this->addRoute('*', $route, $action);
  }

  /**
   * Registra uma nova rota
   * @param string $method
   * @param string $route
   * @param array|callable $action
   */
  private function addRoute($method, $route, $action)
  {
    // Garante que a rota começa com /
    if (substr($route, 0, 1) !== '/') {
      $route = '/' . $route;
    }

    // Adiciona a rota ao array de rotas
    $this->routes[] = [
      'method' => $method,
      'route' => $route,
      'action' => $action
    ];
  }

  /**
   * Executa a aplicação, processando a rota atual
   */
  public function run()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $routeFound = false;

    // Procura uma rota correspondente
    foreach ($this->routes as $route) {
      if (($route['method'] == $method || $route['method'] == '*') && $this->matchRoute($route['route'])) {
        $routeFound = true;
        $this->executeAction($route['action']);
        break;
      }
    }

    // Se nenhuma rota for encontrada, exibe erro 404
    if (!$routeFound) {
      header('HTTP/1.0 404 Not Found');
      echo '404 - Página não encontrada';
    }
  }

  /**
   * Verifica se a rota atual corresponde à rota registrada
   * @param string $routePattern
   * @return bool
   */
  private function matchRoute($routePattern)
  {
    return $routePattern == $this->route;
  }

  /**
   * Executa a ação associada à rota
   * @param array|callable $action
   */
  private function executeAction($action)
  {
    if (is_callable($action)) {
      call_user_func($action);
    } else if (is_array($action) && count($action) == 2) {
      $controller = $action[0];
      $method = $action[1];

      if (is_string($controller)) {
        $controller = new $controller();
      }

      if (method_exists($controller, $method)) {
        call_user_func([$controller, $method]);
      } else {
        throw new \Exception("Método {$method} não encontrado no controlador.");
      }
    } else {
      throw new \Exception('Ação inválida para a rota.');
    }
  }

  /**
   * Retorna a URL base da aplicação
   * @return string
   */
  public function getBaseUrl()
  {
    return $this->baseUrl;
  }

  /**
   * Retorna a rota atual
   * @return string
   */
  public function getCurrentRoute()
  {
    return $this->route;
  }
}
