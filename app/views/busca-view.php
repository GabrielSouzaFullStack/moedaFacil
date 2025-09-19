<?php
// Definir variáveis para o cabeçalho
$pageTitle = 'Busca de Moedas';
$headerText = 'Busca de Moedas';

// Incluir o cabeçalho
include __DIR__ . '/partials/header.php';
?>

<div class="search-form">
  <form method="GET" action="busca.php" class="row g-3">
    <div class="col-md-10">
      <label for="termo" class="form-label">Buscar moeda por nome ou código</label>
      <input type="text" class="form-control form-control-lg" id="termo" name="termo"
        placeholder="Ex: dolar, euro, bitcoin, USD, EUR..."
        value="<?php echo htmlspecialchars($termoBusca ?? ''); ?>" required>
    </div>
    <div class="col-md-2 d-flex align-items-end">
      <button type="submit" class="btn btn-primary btn-lg w-100">Buscar</button>
    </div>
  </form>
</div>

<?php if (isset($termoBusca) && !empty($termoBusca)): ?>
  <div class="search-results mt-4">
    <h3>Resultados da busca por "<?php echo htmlspecialchars($termoBusca); ?>"</h3>
    
    <?php if (!empty($resultados)): ?>
      <div class="row mt-3">
        <?php foreach ($resultados as $codigo => $nome): ?>
          <div class="col-md-4 mb-4">
            <div class="search-card">
              <div class="card h-100">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($nome); ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?php echo $codigo; ?></h6>
                  
                  <?php if (isset($cotacoes[$codigo])): ?>
                    <div class="cotacao-info mt-3">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Valor Atual:</span>
                        <span class="badge bg-primary">R$ <?php echo number_format(floatval($cotacoes[$codigo]['bid']), 4, ',', '.'); ?></span>
                      </div>
                      
                      <div class="d-flex justify-content-between align-items-center">
                        <span>Variação:</span>
                        <span class="badge <?php echo (floatval($cotacoes[$codigo]['pctChange']) >= 0) ? 'bg-success' : 'bg-danger'; ?>">
                          <?php echo $cotacoes[$codigo]['pctChange']; ?>%
                        </span>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="card-footer bg-white">
                  <div class="d-flex gap-2">
                    <a href="conversor.php" class="btn btn-sm btn-outline-primary">Converter</a>
                    <a href="cotacoes.php" class="btn btn-sm btn-outline-secondary">Ver Todas</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="not-found-message">
        <h4>Nenhuma moeda encontrada</h4>
        <p>Tente buscar por outro termo ou verifique a ortografia.</p>
        <p>Exemplos: dólar, euro, bitcoin, USD, EUR, BTC</p>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php include __DIR__ . '/partials/nav.php'; ?>

<?php
// Incluir o rodapé
include __DIR__ . '/partials/footer.php';
?>