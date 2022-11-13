<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <input name="id" value="<?=$educacion['IdEducacion']?>" type="hidden">
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Educacion</label></div>
        <div class="col-md-10 form-group">
            <input name="educacion" value="<?=$educacion['Educacion']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Institucion</label></div>
        <div class="col-md-10 form-group">
            <input name="institucion" value="<?=$educacion['Institucion']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Ciudad</label></div>
        <div class="col-md-10 form-group">
            <input name="ciudad" value="<?=$educacion['Ciudad']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Fecha de inicio</label></div>
        <div class="col-md-10 form-group">
            <input name="fechaInicio" value="<?=$educacion['FechaInicio']?>" class="form-control" type="date">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Presente</label></div>
        <div class="col-md-10 form-group">
            <input name="presente" class="form-check-input" type="checkbox" <?php if ($educacion['Presente']) { ?>checked
                <?php } ?>>
        </div>
    </div>
    <div class="row mt-3 fechaFin">
        <div class="col-md-2 form-group"><label>Fecha de fin</label></div>
        <div class="col-md-10 form-group">
            <input name="fechaFin" value="<?=$educacion['FechaFin']?>" class="form-control" type="date">
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('educacion')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/educacion.js"></script>
<?= $this->endSection() ?>