<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<a href="<?=site_url('social/agregar')?>" class="btn btn-success">Agregar</a>
<div class="row mt-3">
    <table class="tabla table table-bordered table-hover dataTable dtr-inline">
        <thead>
            <tr>
                <th style="width: 01%;">#</th>
                <th style="width: 10%;">Icono</th>
                <th style="width: 80%;">Enlace</th>
                <th style="width: 09%;">Acciones</th>
            </tr>
        </thead>
    </table>
</div>
<a href="<?=site_url('admin')?>" class="btn btn-danger">Cancelar</a>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/social.js"></script>
<?= $this->endSection() ?>