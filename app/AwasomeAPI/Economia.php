<?php

namespace App\AwasomeAPI;


class Economia
{
    /** 
     * URL base da API de economia
     * @var string
     */
    const BASE_URL = 'https://economia.awesomeapi.com.br/json';

    public static $API_KEY;

    /**
     * Método construtor
     */
    public function __construct()
    {
        if (empty(self::$API_KEY)) {
            self::$API_KEY = $_ENV['API_KEY']
                ?? getenv('API_KEY')
                ?? ($_SERVER['API_KEY'] ?? null);
        }
    }

    /** 
     * Método responsável por consultar a cotação de uma moeda.
     * @param string $moedaA
     * @return array
     */
    public function consultarCotacao($moedaA)
    {
        return $this->get('/all/' . $moedaA);
    }

    /**
     * Método responsável por consultar múltiplas cotações de moedas.
     * @param array $moedas Lista de códigos de moedas
     * @return array
     */
    public function consultarMultiplasCotacoes($moedas = ['USD', 'EUR', 'GBP', 'BTC'])
    {
        // Verificar se há moedas para consultar
        if (empty($moedas)) {
            return [];
        }

        try {
            $moedasParam = implode(',', $moedas);
            return $this->get('/all/' . $moedasParam);
        } catch (\Exception $e) {
            // Em caso de erro, tenta consultar individualmente
            $resultado = [];
            foreach ($moedas as $moeda) {
                try {
                    $cotacao = $this->get('/all/' . $moeda);
                    if (!empty($cotacao) && isset($cotacao[$moeda])) {
                        $resultado[$moeda] = $cotacao[$moeda];
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
     * @param array
     */
    public function get($resource)
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

        // Garante que a API Key foi carregada
        if (empty(self::$API_KEY)) {
            self::$API_KEY = $_ENV['API_KEY']
                ?? getenv('API_KEY')
                ?? ($_SERVER['API_KEY'] ?? null);
        }

        // Adiciona header de API Key se disponível
        if (!empty(self::$API_KEY)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'x-api-key: ' . self::$API_KEY
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
