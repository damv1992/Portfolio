<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <input name="proyecto" value="<?=$proyecto?>" type="hidden">
    <input name="id" value="<?=$captura['IdCaptura']?>" type="hidden">
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Captura</label></div>
        <div class="col-md-10 form-group">
            <input class="form-control" type="file" name="imagen">
            <img id="verImagen" width="400"
                <?php if ($captura['Captura']) { ?>src="<?=base_url($captura['Captura'])?>" <?php } ?>>
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('proyecto/capturas/'.$proyecto)?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/captura.js"></script>
<?= $this->endSection() ?>