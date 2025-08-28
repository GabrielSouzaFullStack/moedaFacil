<?php

namespace App\controllers;

use App\awasomeAPI\Economia;

class CotacaoController
{
  public function mostrarCotacao()
  {
    $obEconomia = new Economia();
    $data = $obEconomia->consultarCotacao('USD');
    include __DIR__ . '/../views/cotacao-view.php';
  }
}
