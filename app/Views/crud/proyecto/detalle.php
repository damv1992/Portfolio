<?php
setlocale(LC_TIME, 'es_VE.UTF-8','esp');
?>
<?= $this->extend('plantilla/plantillaVacia') ?>

<?= $this->section('estilos') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        <?php foreach ($capturass as $captura) { ?>
                        <div class="swiper-slide">
                            <img src="<?=base_url($captura['Captura'])?>">
                        </div>
                        <?php } ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Información del proyecto</h3>
                    <ul>
                        <li><strong>Categoría</strong>: <?=ucwords(strtolower($proyecto['Categoria']))?></li>
                        <li><strong>Cliente</strong>: <?=$proyecto['Cliente']?></li>
                        <li><strong>Fecha del proyecto</strong>: <?=strftime('%e de %B de %Y', strtotime($proyecto['Fecha']))?></li>
                        <li><strong>URL del proyecto</strong>:
                            <a href="<?=$proyecto['Enlace']?>" target="_blank"><?=$proyecto['Enlace']?></a>
                        </li>
                    </ul>
                </div>
                <div class="portfolio-description">
                    <h2><?=$proyecto['Titulo']?></h2>
                    <p><?=$proyecto['Descripcion']?></p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $('#header').hide();
</script>
<?= $this->endSection() ?>