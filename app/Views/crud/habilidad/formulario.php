<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <input name="id" value="<?=$habilidad['IdHabilidad']?>" type="hidden">
    <div class="row">
        <div class="col-md-2 form-group"><label>Habilidad</label></div>
        <div class="col-md-10 form-group">
            <input name="habilidad" value="<?=$habilidad['Habilidad']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Porcentaje</label></div>
        <div class="col-md-10 form-group">
            <input name="porcentaje" value="<?=$habilidad['Porcentaje']?>" class="form-control" type="number">
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('habilidad')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/habilidad.js"></script>
<?= $this->endSection() ?>