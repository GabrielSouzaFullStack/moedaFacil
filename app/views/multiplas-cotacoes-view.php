<?php
// Verifica se existem dados
if (!empty($data)) {
    // Definir variáveis para o cabeçalho
    $pageTitle = 'Múltiplas Cotações';
    $headerText = 'Cotações Atualizadas';
    
    // Incluir o cabeçalho
    include __DIR__ . '/partials/header.php';
?>
    <div class="cotacoes-container">
        <?php foreach ($data as $codigo => $moeda): ?>
            <div class="cotacao-card">
                <h3 class="moeda-titulo"><?php echo $moeda['name']; ?></h3>
                <div class="preco">R$ <?php echo number_format(floatval($moeda['bid']), 4, ',', '.'); ?></div>
                <div class="info <?php echo (floatval($moeda['pctChange']) >= 0) ? 'variacao-positiva' : 'variacao-negativa'; ?>">
                    Variação: <?php echo $moeda['pctChange']; ?>%
                </div>
                <div class="info">Atualizado: <?php echo date('d/m/Y H:i', strtotime($moeda['create_date'])); ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include __DIR__ . '/partials/nav.php'; ?>

<?php
    // Incluir o rodapé
    include __DIR__ . '/partials/footer.php';
} else {
    echo '<p>Não há dados de cotações disponíveis no momento.</p>';
}
?>