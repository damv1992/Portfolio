<?php
setlocale(LC_TIME, 'es_VE.UTF-8','esp');
$nacimiento = new DateTime($acerca['Cumpleaños']);
$ahora = new DateTime(date('Y-m-d'));
$diferencia = $ahora->diff($nacimiento);
$edad = $diferencia->format('%y');

if ($acerca['Freelance']) $freelance = 'Disponible';
else $freelance = 'Ocupado';

use App\Models\CapturasModel;
$capturas = new CapturasModel();
?>
<?= $this->extend('plantilla/plantillaPrincipal') ?>

<?= $this->section('estilos') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<style>
    #hero {
        background: url(<?=base_url($configuracion['Fondo'])?>) top right no-repeat;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
        <h1><?=$configuracion['Nombre']?></h1>
        <p>Soy <span class="typed" data-typed-items="<?=$configuracion['Profesiones']?>"></span></p>
        <div class="social-links">
            <?php foreach($socialess as $social) { ?>
            <a href="<?=$social['Enlace']?>" target="_blank"><i class="<?=$social['Icono']?>"></i></a>
            <?php } ?>
        </div>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Acerca</h2>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <img src="<?=base_url($acerca['Foto'])?>" class="img-fluid">
                </div>
                <div class="col-lg-8 pt-4 pt-lg-0 content">
                    <h3><?=$acerca['Titulo']?></h3>
                    <p class="fst-italic"><?=$acerca['Descripcion']?></p>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Cumpleaños:</strong>
                                    <span><?=strftime('%e de %B de %Y', strtotime($acerca['Cumpleaños']))?></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Matrícula:</strong> <span><?=$acerca['Matricula']?></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Teléfono:</strong>
                                    <span>
                                        <a
                                            href="https://wa.me/591<?=$configuracion['Telefono']?>"><?=$configuracion['Telefono']?></a>
                                    </span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Ciudad:</strong> <span><?=$acerca['Ciudad']?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Edad:</strong> <span><?=$edad?></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Grado académico:</strong> <span><?=$acerca['Grado']?></span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>E-mail:</strong>
                                    <span>
                                        <a href="mailto:<?=$configuracion['Correo']?>"><?=$configuracion['Correo']?></a>
                                    </span>
                                </li>
                                <li>
                                    <i class="bi bi-chevron-right"></i>
                                    <strong>Freelance:</strong> <span><?=$freelance?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Habilidades</h2>
            </div>

            <div class="row skills-content">
                <?php foreach ($habilidadess as $habilidad) { ?>
                <div class="col-lg-4">
                    <div class="progress">
                        <span class="skill">
                            <?=$habilidad['Habilidad']?>
                            <i class="val"><?=$habilidad['Porcentaje']?>%</i>
                        </span>
                        <div class="progress-bar-wrap">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?=$habilidad['Porcentaje']?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Resume Section ======= -->
    <section id="resume" class="resume">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Resumen</h2>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h3 class="resume-title">Resumen</h3>
                    <div class="resume-item pb-0">
                        <h4><?=$configuracion['Nombre']?></h4>
                        <p><em><?=$acerca['Descripcion']?></em></p>
                        <ul>
                            <li><?=$acerca['Ciudad']?></li>
                            <li><?=$configuracion['Telefono']?></li>
                            <li><?=$configuracion['Correo']?></li>
                        </ul>
                    </div>
                    
                    <h3 class="resume-title">Experiencia profesional</h3>
                    <?php
                    foreach ($experienciass as $experiencia) {
                        if ($experiencia['Presente']) $fin = 'Presente';
                        else $fin = date('d/m/Y', strtotime($experiencia['FechaFin']));
                    ?>
                    <div class="resume-item">
                        <h4><?=$experiencia['Cargo']?></h4>
                        <h5><?=date('d/m/Y', strtotime($experiencia['FechaInicio']))?> - <?=$fin?></h5>
                        <p><em><?=$experiencia['Empresa']?>, <?=$experiencia['Ciudad']?></em></p>
                        <?=$experiencia['Funciones']?>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-6">
                    <h3 class="resume-title">Educación</h3>
                    <?php
                    foreach ($educacioness as $educacion) {
                        if ($educacion['Presente']) $fin = 'Presente';
                        else $fin = date('d/m/Y', strtotime($educacion['FechaFin']));
                    ?>
                    <div class="resume-item">
                        <h4><?=$educacion['Educacion']?></h4>
                        <h5><?=date('d/m/Y', strtotime($educacion['FechaInicio']))?> - <?=$fin?></h5>
                        <p><em><?=$educacion['Institucion']?>, <?=$educacion['Ciudad']?></em></p>
                    </div>
                    <?php } ?>
                    
                    <h3 class="resume-title">Cursos</h3>
                    <?php
                    foreach ($cursoss as $curso) {
                        if ($curso['Presente']) $fin = 'Presente';
                        else $fin = date('d/m/Y', strtotime($curso['FechaFin']));
                    ?>
                    <div class="resume-item">
                        <h4><?=$curso['Curso']?></h4>
                        <h5><?=date('d/m/Y', strtotime($curso['FechaInicio']))?> - <?=$fin?></h5>
                        <p><em><?=$curso['Institucion']?></em></p>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </section><!-- End Resume Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Proyectos</h2>
            </div>

            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">Todos</li>
                        <?php foreach ($categorias as $categoria) { ?>
                        <li data-filter=".filter-<?=$categoria['Categoria']?>"><?=$categoria['Categoria']?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                <?php
                foreach ($proyectoss as $proyecto) {
                    $captura = $capturas->where('Proyecto', $proyecto['IdProyecto'])->first();
                    $captura = $captura['Captura'];
                    if (!$captura) $captura = base_url('custom/img/blanco.png');
                ?>
                <div class="col-lg-4 col-md-6 portfolio-item filter-<?=$proyecto['Categoria']?>">
                    <div class="portfolio-wrap">
                        <img src="<?=base_url($captura)?>" class="img-fluid">
                        <div class="portfolio-info">
                            <h4><?=$proyecto['Titulo']?></h4>
                            <p><?=$proyecto['Descripcion']?></p>
                            <div class="portfolio-links">
                                <a href="<?=base_url($captura)?>"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox"><i
                                        class="bx bx-plus"></i></a>
                                <a href="<?=site_url('proyecto/detalle/'.$proyecto['IdProyecto'])?>" class="portfolio-details-lightbox"
                                    data-glightbox="type: external"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Contacto</h2>
            </div>

            <div class="row mt-1">

                <div class="col-lg-4">
                    <div class="info">
                        <?php if ($configuracion['Direccion']) { ?>
                        <div class="address">
                            <i class="bi bi-geo-alt"></i>
                            <h4>Dirección:</h4>
                            <p><?=$configuracion['Direccion']?></p>
                        </div>
                        <?php } ?>

                        <?php if ($configuracion['Correo']) { ?>
                        <div class="email">
                            <i class="bi bi-envelope"></i>
                            <h4>Correo electrónico:</h4>
                            <p><a href="mailto:<?=$configuracion['Correo']?>"><?=$configuracion['Correo']?></a></p>
                        </div>
                        <?php } ?>

                        <?php if ($configuracion['Telefono']) { ?>
                        <div class="phone">
                            <i class="bi bi-phone"></i>
                            <h4>Teléfono:</h4>
                            <p><a
                                    href="https://wa.me/591<?=$configuracion['Telefono']?>"><?=$configuracion['Telefono']?></a>
                            </p>
                        </div>
                        <?php } ?>

                    </div>

                </div>

                <div class="col-lg-8 mt-5 mt-lg-0">

                    <form class="formContacto php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre completo"
                                    required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="correo" placeholder="Correo electrónico"
                                    required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="asunto" placeholder="Asunto" required>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="mensaje" rows="5" placeholder="Mensaje"
                                required></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="text-start"><button class="btnEnviarWhatsApp" type="button">Enviar
                                    WhatsApp</button></div>
                            <div class="text-center"><button class="btnEnviarCorreo" type="submit">Enviar
                                    mensaje</button></div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="container">
        <h3><?=$configuracion['Nombre']?></h3>
        <p><?=$configuracion['Profesiones']?>.</p>
        <div class="social-links">
            <?php foreach($socialess as $social) { ?>
            <a href="<?=$social['Enlace']?>" target="_blank"><i class="<?=$social['Icono']?>"></i></a>
            <?php } ?>
        </div>
        <div class="copyright">
            &copy; Copyright <strong><span>
                    <a href="https://wa.me/59173354006">Ing. Daniel Alejandro Miranda Villalta</a></span></strong>.
            Todos los derechos reservados
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: [license-url] -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-html-bootstrap-template-my-resume/ -->
            <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
        </div>
    </div>
</footer><!-- End Footer -->
<?= $this->endSection() ?>