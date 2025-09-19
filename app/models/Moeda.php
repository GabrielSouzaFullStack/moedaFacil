<?php

namespace App\Models;

/**
 * Class Moeda
 * Modelo para representação de Moeda e suas cotações
 * @package App\Models
 */
class Moeda
{
  /** 
   * URL base da API de economia
   * @var string
   */
  const BASE_URL = 'https://economia.awesomeapi.com.br/json';

  /**
   * API Key para autenticação na API
   * @var string|null
   */
  private static $apiKey;

  /**
   * Código da moeda
   * @var string
   */
  private $codigo;

  /**
   * Nome da moeda para exibição
   * @var string
   */
  private $nome;

  /**
   * Dados da cotação da moeda
   * @var array|null
   */
  private $cotacao;

  /**
   * Método construtor
   * @param string $codigo Código da moeda (ex: USD, EUR)
   * @param string $nome Nome da moeda para exibição
   */
  public function __construct($codigo = null, $nome = null)
  {
    if (isset($_ENV['API_KEY'])) {
      self::$apiKey = $_ENV['API_KEY'];
    }

    $this->codigo = $codigo;
    $this->nome = $nome;
  }

  /**
   * Retorna o código da moeda
   * @return string
   */
  public function getCodigo()
  {
    return $this->codigo;
  }

  /**
   * Define o código da moeda
   * @param string $codigo
   * @return self
   */
  public function setCodigo($codigo)
  {
    $this->codigo = $codigo;
    return $this;
  }

  /**
   * Retorna o nome da moeda
   * @return string
   */
  public function getNome()
  {
    return $this->nome;
  }

  /**
   * Define o nome da moeda
   * @param string $nome
   * @return self
   */
  public function setNome($nome)
  {
    $this->nome = $nome;
    return $this;
  }

  /**
   * Retorna os dados da cotação
   * @return array|null
   */
  public function getCotacao()
  {
    return $this->cotacao;
  }

  /**
   * Carrega a cotação atual da moeda
   * @return self
   * @throws \Exception
   */
  public function carregarCotacao()
  {
    if (!$this->codigo) {
      throw new \Exception('Código da moeda não definido');
    }

    $this->cotacao = $this->get('/all/' . $this->codigo);
    return $this;
  }

  /** 
   * Método responsável por consultar a cotação de uma moeda.
   * @param string $codigoMoeda
   * @return array
   */
  public static function consultarCotacao($codigoMoeda)
  {
    $moeda = new self($codigoMoeda);
    return $moeda->get('/all/' . $codigoMoeda);
  }

  /**
   * Método responsável por consultar múltiplas cotações de moedas.
   * @param array $codigos Lista de códigos de moedas
   * @return array
   */
  public static function consultarMultiplasCotacoes($codigos = ['USD', 'EUR', 'GBP', 'BTC'])
  {
    // Verificar se há moedas para consultar
    if (empty($codigos)) {
      return [];
    }

    try {
      $moedasParam = implode(',', $codigos);
      $moeda = new self();
      return $moeda->get('/all/' . $moedasParam);
    } catch (\Exception $e) {
      // Em caso de erro, tenta consultar individualmente
      $resultado = [];
      foreach ($codigos as $codigo) {
        try {
          $moeda = new self($codigo);
          $cotacao = $moeda->get('/all/' . $codigo);
          if (!empty($cotacao) && isset($cotacao[$codigo])) {
            $resultado[$codigo] = $cotacao[$codigo];
          }
        } catch (\Exception $e) {
          // Ignora erros individuais
          continue;
        }
      }
      return $resultado;
    }
  }

  /**
   * Método responsável por realizar a consulta na API. 
   * @param string $resource
   * @return array
   * @throws \Exception
   */
  private function get($resource)
  {
    // ENDPOINT
    $endpoint = self::BASE_URL . $resource;

    // Inicializa o CURL
    $curl = curl_init();

    // Config CURL
    curl_setopt_array($curl, [
      CURLOPT_URL => $endpoint,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => 'GET'
    ]);

    // Adiciona header de API Key se disponível
    if (!empty(self::$apiKey)) {
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'x-api-key: ' . self::$apiKey
      ]);
    }

    // RESPONSE
    $response = curl_exec($curl);

    // Verifica se houve erro na requisição
    if ($response === false) {
      $error = curl_error($curl);
      curl_close($curl);
      throw new \Exception('Erro na requisição cURL: ' . $error);
    }

    // Encerra conexão CURL
    curl_close($curl);

    // Decodifica o JSON
    $data = json_decode($response, true);

    // Verifica se a resposta é válida
    if (json_last_error() !== JSON_ERROR_NONE) {
      throw new \Exception('Erro ao decodificar JSON: ' . json_last_error_msg());
    }

    // Retorna Array
    return $data;
  }
}
