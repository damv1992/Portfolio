<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <input name="id" value="<?=$social['IdRedSocial']?>" type="hidden">
    <div class="row">
        <p class="text-danger">
            <strong>IMPORTANTE:</strong>
            Puede buscar iconos en <a href="https://boxicons.com/" target="_blank">https://boxicons.com/</a></p>
        <div class="col-md-2 form-group"><label>Icono</label></div>
        <div class="col-md-10 form-group">
            <input name="icono" value="<?=$social['Icono']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Enlace</label></div>
        <div class="col-md-10 form-group">
            <input name="enlace" value="<?=$social['Enlace']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('social')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/social.js"></script>
<?= $this->endSection() ?>