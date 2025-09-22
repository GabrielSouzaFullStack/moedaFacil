<?php
// Verifica se existem dados
if (!empty($data)) {
    // Definir variáveis para o cabeçalho
    $pageTitle = 'Múltiplas Cotações';
    $headerText = 'Cotações Atualizadas';


    // Incluir o cabeçalho
    include __DIR__ . '/partials/header.php';
?>
    <div class="cotacoes-owl-carousel owl-carousel owl-theme">
        <?php foreach ($data as $codigo => $moeda): ?>
            <div class="cotacao-card">
                <h3 class="moeda-titulo"><?php echo $moeda['name'] ?? 'Sem nome'; ?></h3>
                <div class="preco">R$ <?php echo number_format(floatval($moeda['bid'] ?? 0), 4, ',', '.'); ?></div>
                <div class="info <?php echo (floatval($moeda['pctChange'] ?? 0) >= 0) ? 'variacao-positiva' : 'variacao-negativa'; ?>">
                    Variação: <?php echo $moeda['pctChange'] ?? 0; ?>%
                </div>
                <span class="data-atualizacao badge bg-secondary">
                    Atualizado: 
                    <?php $dataAtualizacao = $moeda['create_date'] ?? null; ?>
                    <?php echo date('d/m/Y H:i', strtotime($dataAtualizacao)); ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include __DIR__ . '/partials/nav.php'; ?>

    <?php
    // Incluir o rodapé
    include __DIR__ . '/partials/footer.php';
    ?>

    <script>
        $(document).ready(function() {

            // Verifica se é desktop (768px ou maior)
            function isDesktop() {
                return $(window).width() >= 768;
            }

            // Função para inicializar o carrossel
            function initCarousel() {
                if (isDesktop()) {

                    var $carousel = $('.cotacoes-owl-carousel');

                    if ($carousel.length > 0) {

                        // Verifica se o Owl Carousel está disponível
                        if (typeof $.fn.owlCarousel !== 'undefined') {
                            console.log('Owl Carousel plugin carregado');

                            // Força display block antes de inicializar
                            $carousel.css('display', 'block');

                            // Inicializa o Owl Carousel
                            $carousel.owlCarousel({
                                loop: true,
                                margin: 10,
                                nav: true,
                                navText: ['‹', '›'],
                                dots: false,
                                autoplay: true,
                                autoplayTimeout: 3000,
                                autoplayHoverPause: true,
                                smartSpeed: 1000,
                                responsive: {
                                    768: {
                                        items: 2
                                    },
                                    992: {
                                        items: 3
                                    },
                                    1200: {
                                        items: 4
                                    }
                                }
                            });
                        }
                    }
                } else {
                    // Remove qualquer inicialização do carrossel se existir
                    var $carousel = $('.cotacoes-owl-carousel');
                    if ($carousel.hasClass('owl-carousel')) {
                        $carousel.trigger('destroy.owl.carousel');
                        $carousel.removeClass('owl-carousel owl-stage-outer');
                    }
                }
            }

            // Inicializa na carga da página
            initCarousel();

            // Reinicializa ao redimensionar a janela
            $(window).resize(function() {
                initCarousel();
            });
        });
    </script>
<?php
} else {
    echo '<p>Não há dados de cotações disponíveis no momento.</p>';
}
?>