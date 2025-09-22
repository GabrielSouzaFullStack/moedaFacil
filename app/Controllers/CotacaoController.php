<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Moeda;
use App\Models\CatalogoMoedas;

/**
 * Class CotacaoController
 * Controlador para gerenciar cotações de moedas
 * @package App\Controllers
 */
class CotacaoController extends Controller
{
  /**
   * Método responsável por mostrar a cotação de uma moeda específica
   * @param string $moeda Código da moeda (padrão: USD)
   */
  public function mostrarCotacao($moeda = 'USD')
  {
    // Obter a moeda da URL se existir
    $moedaParam = isset($_GET['moeda']) ? strtoupper($_GET['moeda']) : $moeda;

    // Obter cotação da moeda
    $data = Moeda::consultarCotacao($moedaParam);

    // Nome da moeda para título da página
    $nomeMoeda = CatalogoMoedas::getNomeMoeda($moedaParam) ?: $moedaParam;

    if (!empty($data)) {
      $this->render('cotacao-view', [
        'data' => $data,
        'nomeMoeda' => $nomeMoeda
      ]);
    } else {
      echo '<p>Não foi possível obter dados da API. Verifique sua conexão ou a quota de requisições.</p>';
    }
  }

  /**
   * Método responsável por mostrar múltiplas cotações
   */
  public function mostrarMultiplasCotacoes()
  {
    // Lista expandida de moedas para exibir todas as cotações
    $moedas = [
      'USD',
      'EUR',
      'GBP',
      'BTC',
      'CAD',
      'AUD',
      'ARS',
      'JPY',
      'CHF',
      'CNY',
      'LTC',
      'ETH',
      'XRP',
      'DOGE'
    ];

    $data = Moeda::consultarMultiplasCotacoes($moedas);

    if (!empty($data)) {
      $this->render('multiplas-cotacoes-view', [
        'data' => $data
      ]);
    } else {
      echo '<p>Não foi possível obter dados da API. Verifique sua conexão ou a quota de requisições.</p>';
    }
  }
  /**
   * Método responsável por mostrar o conversor de moedas
   */
  public function mostrarConversor()
  {
    $moedasLista = ['USD', 'EUR', 'GBP', 'BTC', 'ARS', 'JPY'];
    $moedas = Moeda::consultarMultiplasCotacoes($moedasLista);

    // Processa a conversão se houver dados POST
    $resultado = null;
    $valorOrigem = null;
    $moedaOrigem = null;
    $moedaDestino = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['valor']) && !empty($_POST['moeda_origem']) && !empty($_POST['moeda_destino'])) {
      $valorOrigem = floatval($_POST['valor']);
      $moedaOrigem = $_POST['moeda_origem'];
      $moedaDestino = $_POST['moeda_destino'];

      if ($moedaOrigem === 'BRL') {
        // Convertendo de Real para outra moeda
        $cotacaoDestino = isset($moedas[$moedaDestino]) ? floatval($moedas[$moedaDestino]['bid']) : 0;
        if ($cotacaoDestino > 0) {
          $resultado = $valorOrigem / $cotacaoDestino;
        }
      } elseif ($moedaDestino === 'BRL') {
        // Convertendo de outra moeda para Real
        $cotacaoOrigem = isset($moedas[$moedaOrigem]) ? floatval($moedas[$moedaOrigem]['bid']) : 0;
        if ($cotacaoOrigem > 0) {
          $resultado = $valorOrigem * $cotacaoOrigem;
        }
      } else {
        // Convertendo entre duas moedas estrangeiras
        $cotacaoOrigem = isset($moedas[$moedaOrigem]) ? floatval($moedas[$moedaOrigem]['bid']) : 0;
        $cotacaoDestino = isset($moedas[$moedaDestino]) ? floatval($moedas[$moedaDestino]['bid']) : 0;
        if ($cotacaoOrigem > 0 && $cotacaoDestino > 0) {
          // Primeiro converte para real, depois para moeda destino
          $valorEmReal = $valorOrigem * $cotacaoOrigem;
          $resultado = $valorEmReal / $cotacaoDestino;
        }
      }
    }

    // Lista de moedas para o select
    $listaMoedas = [
      'BRL' => 'Real Brasileiro',
      'USD' => 'Dólar Americano',
      'EUR' => 'Euro',
      'GBP' => 'Libra Esterlina',
      'BTC' => 'Bitcoin',
      'ARS' => 'Peso Argentino',
      'JPY' => 'Iene Japonês',
      'CAD' => 'Dólar Canadense',
      'AUD' => 'Dólar Australiano',
      'CHF' => 'Franco Suíço',
      'CNY' => 'Yuan Chinês',
      'LTC' => 'Litecoin',
      'ETH' => 'Ethereum',
      'XRP' => 'XRP (Ripple)',
      'DOGE' => 'Dogecoin'
    ];

    // Renderiza a view
    $this->render('conversor-view', [
      'listaMoedas' => $listaMoedas,
      'resultado' => $resultado,
      'valorOrigem' => $valorOrigem,
      'moedaOrigem' => $moedaOrigem,
      'moedaDestino' => $moedaDestino,
      'moedas' => $moedas
    ]);
  }

  /**
   * Método responsável por buscar moedas por nome
   */
  public function buscarMoedas()
  {
    // Lista completa de moedas disponíveis na AwesomeAPI
    $todasMoedas = [
      'USD' => 'Dólar Americano',
      'USD-BRLT' => 'Dólar Americano (BRLT)',
      'CAD' => 'Dólar Canadense',
      'EUR' => 'Euro',
      'GBP' => 'Libra Esterlina',
      'ARS' => 'Peso Argentino',
      'BTC' => 'Bitcoin',
      'LTC' => 'Litecoin',
      'JPY' => 'Iene Japonês',
      'CHF' => 'Franco Suíço',
      'AUD' => 'Dólar Australiano',
      'CNY' => 'Yuan Chinês',
      'ILS' => 'Novo Shekel Israelense',
      'ETH' => 'Ethereum',
      'XRP' => 'XRP (Ripple)',
      'DOGE' => 'Dogecoin',
      'ADA' => 'Cardano',
      'DOT' => 'Polkadot',
      'SOL' => 'Solana',
      'USDT' => 'Tether',
      'XMR' => 'Monero',
      'USDC' => 'USD Coin',
      'LINK' => 'Chainlink',
      'DAI' => 'Dai',
      'DASH' => 'Dash'
    ];

    // Termo de busca
    $termoBusca = isset($_GET['termo']) ? strtolower(trim($_GET['termo'])) : '';
    $resultados = [];

    if (!empty($termoBusca)) {
      // Busca nas moedas
      foreach ($todasMoedas as $codigo => $nome) {
        if (
          strpos(strtolower($codigo), $termoBusca) !== false ||
          strpos(strtolower($nome), $termoBusca) !== false
        ) {
          $resultados[$codigo] = $nome;
        }
      }
    }

    // Obter cotações para as moedas encontradas
    $cotacoes = [];
    if (!empty($resultados)) {
      $codigosMoedas = array_keys($resultados);

      // Dividir em lotes de 5 moedas para evitar exceder a quota da API
      $lotes = array_chunk($codigosMoedas, 5);

      foreach ($lotes as $lote) {
        $cotacoesLote = Moeda::consultarMultiplasCotacoes($lote);
        if (!empty($cotacoesLote)) {
          $cotacoes = array_merge($cotacoes, $cotacoesLote);
        }
      }
    }

    // Renderiza a view
    $this->render('busca-view', [
      'termoBusca' => $termoBusca,
      'resultados' => $resultados,
      'cotacoes' => $cotacoes
    ]);
  }
}
