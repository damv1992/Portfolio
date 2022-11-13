<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <input name="id" value="<?=$experiencia['IdExperiencia']?>" type="hidden">
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Empresa</label></div>
        <div class="col-md-10 form-group">
            <input name="empresa" value="<?=$experiencia['Empresa']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Cargo</label></div>
        <div class="col-md-10 form-group">
            <input name="cargo" value="<?=$experiencia['Cargo']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Ciudad</label></div>
        <div class="col-md-10 form-group">
            <input name="ciudad" value="<?=$experiencia['Ciudad']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Fecha de inicio</label></div>
        <div class="col-md-10 form-group">
            <input name="fechaInicio" value="<?=$experiencia['FechaInicio']?>" class="form-control" type="date">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Presente</label></div>
        <div class="col-md-10 form-group">
            <input name="presente" class="form-check-input" type="checkbox" <?php if ($experiencia['Presente']) { ?>checked
                <?php } ?>>
        </div>
    </div>
    <div class="row mt-3 fechaFin">
        <div class="col-md-2 form-group"><label>Fecha de fin</label></div>
        <div class="col-md-10 form-group">
            <input name="fechaFin" value="<?=$experiencia['FechaFin']?>" class="form-control" type="date">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Funciones</label></div>
        <div class="col-md-10 form-group">
            <div id="herramientas"></div>
            <div name="funciones" style="border-color: rgb(233, 233, 233);"><p><?=$experiencia['Funciones']?></p></div>
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('experiencia')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/experiencia.js"></script>
<?= $this->endSection() ?>