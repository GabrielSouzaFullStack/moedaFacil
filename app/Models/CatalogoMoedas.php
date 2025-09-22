<?php

namespace App\Models;

/**
 * Class CatalogoMoedas
 * Modelo para gerenciamento do catálogo de moedas disponíveis
 * @package App\Models
 */
class CatalogoMoedas
{
  /**
   * Lista de moedas disponíveis com seus nomes
   * @var array
   */
  private static $moedas = [
    'USD' => 'Dólar Americano',
    'EUR' => 'Euro',
    'GBP' => 'Libra Esterlina',
    'BTC' => 'Bitcoin',
    'CAD' => 'Dólar Canadense',
    'AUD' => 'Dólar Australiano',
    'ARS' => 'Peso Argentino',
    'JPY' => 'Iene Japonês',
    'CNY' => 'Yuan Chinês',
    'CHF' => 'Franco Suíço'
  ];

  /**
   * Retorna a lista completa de moedas disponíveis
   * @return array
   */
  public static function listarTodas()
  {
    return self::$moedas;
  }

  /**
   * Verifica se uma moeda existe no catálogo
   * @param string $codigo
   * @return bool
   */
  public static function existeMoeda($codigo)
  {
    return isset(self::$moedas[$codigo]);
  }

  /**
   * Retorna o nome de uma moeda pelo seu código
   * @param string $codigo
   * @return string|null
   */
  public static function getNomeMoeda($codigo)
  {
    return self::existeMoeda($codigo) ? self::$moedas[$codigo] : null;
  }

  /**
   * Retorna um array com as principais moedas para exibição
   * @param int $quantidade Número de moedas a retornar
   * @return array
   */
  public static function getMoedasPrincipais($quantidade = 4)
  {
    $principais = ['USD', 'EUR', 'GBP', 'BTC'];
    return array_slice($principais, 0, $quantidade);
  }

  /**
   * Cria uma instância de Moeda a partir do código
   * @param string $codigo
   * @return Moeda
   */
  public static function getMoeda($codigo)
  {
    $nome = self::getNomeMoeda($codigo);
    return new Moeda($codigo, $nome);
  }
}
