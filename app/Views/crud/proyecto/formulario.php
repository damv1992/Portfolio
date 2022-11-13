<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <input name="id" value="<?=$proyecto['IdProyecto']?>" type="hidden">
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Titulo</label></div>
        <div class="col-md-10 form-group">
            <input name="titulo" value="<?=$proyecto['Titulo']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Categoria</label></div>
        <div class="col-md-10 form-group">
            <input name="categoria" value="<?=$proyecto['Categoria']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Cliente</label></div>
        <div class="col-md-10 form-group">
            <input name="cliente" value="<?=$proyecto['Cliente']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Enlace</label></div>
        <div class="col-md-10 form-group">
            <input name="enlace" value="<?=$proyecto['Enlace']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Fecha</label></div>
        <div class="col-md-10 form-group">
            <input name="fecha" value="<?=$proyecto['Fecha']?>" class="form-control" type="date">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Descripcion</label></div>
        <div class="col-md-10 form-group">
            <div id="herramientas"></div>
            <div name="descripcion" style="border-color: rgb(233, 233, 233);"><p><?=$proyecto['Descripcion']?></p></div>
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('proyecto')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/proyecto.js"></script>
<?= $this->endSection() ?>