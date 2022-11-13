<?= $this->extend('plantilla/plantillaPrincipal') ?>

<?= $this->section('estilos') ?>
<?= $this->renderSection('estilosAdmin') ?>
<?= $this->endSection() ?>

<?= $this->section('contenido') ?>
<main id="main">
    <section>
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-3">
                    <div class="d-grid gap-2">
                        <a href="<?=site_url('pagina')?>" class="pagina btn btn-secondary" type="button">Pagina</a>
                        <a href="<?=site_url('social')?>" class="social btn btn-secondary" type="button">Redes Sociales</a>
                        <a href="<?=site_url('acerca')?>" class="acerca btn btn-secondary" type="button">Acerca</a>
                        <a href="<?=site_url('habilidad')?>" class="habilidad btn btn-secondary" type="button">Habilidades</a>
                        <a href="<?=site_url('experiencia')?>" class="experiencia btn btn-secondary" type="button">Experiencias</a>
                        <a href="<?=site_url('educacion')?>" class="educacion btn btn-secondary" type="button">Educaciones</a>
                        <a href="<?=site_url('curso')?>" class="curso btn btn-secondary" type="button">Cursos</a>
                        <a href="<?=site_url('proyecto')?>" class="proyecto btn btn-secondary" type="button">Proyectos</a>
                    </div>
                </div>
                <div class="col-lg-9 content">
                    <?= $this->renderSection('contenidoAdmin') ?>
                </div>
            </div>

        </div>
    </section>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $('.active').not('.admins').removeClass('active');
    $('.admins').addClass('active');
</script>
<?= $this->renderSection('scriptsAdmin') ?>
<?= $this->endSection() ?>