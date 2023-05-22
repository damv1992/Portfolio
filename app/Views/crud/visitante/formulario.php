<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <div class="row">
        <div class="col-md-2 form-group"><label>IP</label></div>
        <div class="col-md-10 form-group">
            <input name="ip" value="<?=$visitante['Ip']?>" class="form-control" type="text" disabled>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Perteneciente</label></div>
        <div class="col-md-10 form-group">
            <input name="perteneciente" value="<?=$visitante['Perteneciente']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('visitante')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/visitante.js"></script>
<?= $this->endSection() ?>