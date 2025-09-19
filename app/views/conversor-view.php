<?php
// Definir variáveis para o cabeçalho
$pageTitle = 'Conversor de Moedas';
$headerText = 'Conversor de Moedas';

// Incluir o cabeçalho
include __DIR__ . '/partials/header.php';
?>

<div class="row">
  <div class="col-md-8 mx-auto">
    <div class="card mb-4">
      <div class="card-body">
        <form method="POST" action="conversor.php">
          <div class="row mb-3">
            <div class="col-md-4 mb-3 mb-md-0">
              <label for="valor" class="form-label">Valor</label>
              <input type="number" class="form-control" id="valor" name="valor" step="0.01" min="0.01" value="<?php echo $valorOrigem ?? 1; ?>" required>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
              <label for="moeda_origem" class="form-label">De</label>
              <select class="form-select" id="moeda_origem" name="moeda_origem" required>
                <?php foreach ($listaMoedas as $codigo => $nome): ?>
                  <option value="<?php echo $codigo; ?>" <?php echo (isset($moedaOrigem) && $moedaOrigem === $codigo) ? 'selected' : ''; ?>>
                    <?php echo $nome; ?> (<?php echo $codigo; ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label for="moeda_destino" class="form-label">Para</label>
              <select class="form-select" id="moeda_destino" name="moeda_destino" required>
                <?php foreach ($listaMoedas as $codigo => $nome): ?>
                  <option value="<?php echo $codigo; ?>" <?php echo (isset($moedaDestino) && $moedaDestino === $codigo) ? 'selected' : ''; ?>>
                    <?php echo $nome; ?> (<?php echo $codigo; ?>)
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Converter</button>
          </div>
        </form>
      </div>
    </div>

    <?php if (isset($resultado)): ?>
      <div class="card mb-4 result-card">
        <div class="card-body">
          <h5 class="card-title">Resultado da Conversão</h5>
          <div class="result">
            <div class="row align-items-center">
              <div class="col-md-5 text-end">
                <h3><?php echo number_format($valorOrigem, 2, ',', '.'); ?> <?php echo $moedaOrigem; ?></h3>
                <p class="text-muted"><?php echo $listaMoedas[$moedaOrigem]; ?></p>
              </div>
              <div class="col-md-2 text-center">
                <i class="bi bi-arrow-right fs-1">➡️</i>
              </div>
              <div class="col-md-5 text-start">
                <h3><?php echo number_format($resultado, 2, ',', '.'); ?> <?php echo $moedaDestino; ?></h3>
                <p class="text-muted"><?php echo $listaMoedas[$moedaDestino]; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header bg-light">
        <h5 class="mb-0">Cotações atuais utilizadas nas conversões</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <?php foreach ($moedas as $codigo => $cotacao): ?>
            <div class="col-md-4 col-sm-6 mb-3">
              <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                  <h6 class="card-title d-flex justify-content-between align-items-center">
                    <span><?php echo $codigo; ?></span>
                    <span class="badge bg-primary">R$ <?php echo number_format(floatval($cotacao['bid']), 2, ',', '.'); ?></span>
                  </h6>
                  <p class="card-text small text-muted">
                    Atualizado em: <?php echo date('d/m/Y H:i:s', strtotime($cotacao['create_date'])); ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__ . '/partials/nav.php'; ?>

<?php
// Incluir o rodapé
include __DIR__ . '/partials/footer.php';
?>