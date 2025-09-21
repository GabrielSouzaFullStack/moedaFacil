<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Moeda Fácil - <?php echo $pageTitle ?? 'Cotações'; ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles/template.min.css">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <?php if (isset($additionalStyles)) echo $additionalStyles; ?>
</head>

<body>
  <div class="header">
    <div class="container-fluid">
      <div class="logo-container">
        <a href="index.php">
          <img src="img/logo.svg" alt="Logo Moeda Fácil" class="logo">
        </a>
      </div>
      <p style="font-weight: bold;" class="lead"><?php echo $headerText ?? 'Cotações de Moedas'; ?></p>
    </div>
  </div>

  <div class="container">