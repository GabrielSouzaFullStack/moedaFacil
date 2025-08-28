<?php

namespace App\awasomeAPI;


class Economia
{
    /** 
     * URL base da API de economia
     * @var string
     */
    const BASE_URL = 'https://economia.awesomeapi.com.br/json';

    public static $API_KEY;
    
    /** 
     * Método responsável por consulara as cotações de moedas.
     * @param string $moedaA
     * @param string $moedaB
     * @return array
     */
    public function consultarCotacao($moedaA)
    {
        return $this->get('/all/' . $moedaA);
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
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'x-api-key: ' . self::$API_KEY = $_ENV['API_KEY']
            ]
        ]);

        //RESPONSE
        $response = curl_exec($curl);

        if ($response === false) {
            echo 'Erro cURL: ' . curl_error($curl);
        }

        // Encerra conexão CURL
        curl_close($curl);


        // Retorna Array
        return json_decode($response, true);
    }
}
