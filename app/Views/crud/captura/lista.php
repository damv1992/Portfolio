<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<input name="proyecto" value="<?=$proyecto['IdProyecto']?>" type="hidden">
<a href="<?=site_url('captura/agregar/'.$proyecto['IdProyecto'])?>" class="btn btn-success">Agregar</a>
<div class="row mt-3">
    <table class="tabla table table-bordered table-hover dataTable dtr-inline">
        <thead>
            <tr>
                <th style="width: 01%;">#</th>
                <th>Captura</th>
                <th style="width: 09%;">Acciones</th>
            </tr>
        </thead>
    </table>
</div>
<a href="<?=site_url('proyecto')?>" class="btn btn-danger">Cancelar</a>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/captura.js"></script>
<?= $this->endSection() ?>