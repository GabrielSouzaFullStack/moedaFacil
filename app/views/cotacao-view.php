<?php
if (isset($data['USD'])) {
    $cotacao = $data['USD'];
?>
    <h2>Cotação do Dólar</h2>
    <ul>
        <li>
            Moeda: <?php echo $cotacao['code']; ?> (<?php echo $cotacao['name']; ?>)
        </li>
        <li>
            Valor de compra (bid): <?php echo $cotacao['bid']; ?>
        </li>
        <li>
            Valor de venda (ask): <?php echo $cotacao['ask']; ?>
        </li>
        <li>
            Maior valor do dia: <?php echo $cotacao['high']; ?>
        </li>
        <li>
            Menor valor do dia: <?php echo $cotacao['low']; ?>
        </li>
        <li>
            Variação: <?php echo $cotacao['varBid']; ?>
        </li>
        <li>
            Percentual de variação: <?php echo $cotacao['pctChange']; ?>%
        </li>
        <li>
            Data da cotação: <?php echo $cotacao['create_date']; ?>
        </li>
    </ul>
<?php
} else {
    echo "<p>Dados não disponíveis.</p>";
}
?>