<?php
// Determinar qual moeda está sendo exibida (usando o parâmetro da URL ou USD como padrão)
$moedaCodigo = isset($_GET['moeda']) ? strtoupper($_GET['moeda']) : 'USD';

if (isset($data[$moedaCodigo])) {
    $cotacao = $data[$moedaCodigo];
    
    // Definir variáveis para o cabeçalho
    $pageTitle = 'Cotação ' . $cotacao['name'];
    $headerText = 'Cotação de ' . $cotacao['name'];
    
    // Incluir o cabeçalho
    include __DIR__ . '/partials/header.php';
?>
    <div class="cotacao-card">
        <div class="moeda-info">
            <h2 class="moeda-nome"><?php echo $cotacao['name']; ?> (<?php echo $moedaCodigo; ?>)</h2>
            <div class="valor-principal">
                R$ <?php echo number_format(floatval($cotacao['bid']), 4, ',', '.'); ?>
            </div>

            <div class="d-flex align-items-center mb-3">
                <span class="me-3">Variação hoje:</span>
                <span class="badge <?php echo (floatval($cotacao['pctChange']) >= 0) ? 'bg-success' : 'bg-danger'; ?> fs-6">
                    <?php echo (floatval($cotacao['pctChange']) >= 0) ? '+' : ''; ?><?php echo $cotacao['pctChange']; ?>%
                </span>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Valor de Compra</div>
                    <div class="info-value">R$ <?php echo number_format(floatval($cotacao['bid']), 4, ',', '.'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Valor de Venda</div>
                    <div class="info-value">R$ <?php echo number_format(floatval($cotacao['ask']), 4, ',', '.'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Máxima do Dia</div>
                    <div class="info-value">R$ <?php echo number_format(floatval($cotacao['high']), 4, ',', '.'); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Mínima do Dia</div>
                    <div class="info-value">R$ <?php echo number_format(floatval($cotacao['low']), 4, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/partials/nav.php'; ?>

<?php
    // Incluir o rodapé
    include __DIR__ . '/partials/footer.php';
} else {
    echo "<div class='alert alert-danger'>Dados não disponíveis. Verifique sua conexão ou a quota de requisições da API.</div>";
}
?>