<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <div class="row">
        <div class="col-md-2 form-group"><label>Nombre</label></div>
        <div class="col-md-10 form-group">
            <input name="nombre" value="<?=$configuracion['Nombre']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Icono</label></div>
        <div class="col-md-10 form-group">
            <input class="form-control" type="file" name="icono">
            <img id="verIcono" width="32" height="32"
                <?php if ($configuracion['Icono']) { ?>src="<?=base_url($configuracion['Icono'])?>" <?php } ?>>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Fondo</label></div>
        <div class="col-md-10 form-group">
            <input class="form-control" type="file" name="fondo">
            <img id="verFondo" width="640" height="351"
                <?php if ($configuracion['Fondo']) { ?>src="<?=base_url($configuracion['Fondo'])?>" <?php } ?>>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Profesiones (, )</label></div>
        <div class="col-md-10 form-group">
            <input name="profesiones" value="<?=$configuracion['Profesiones']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Correo electrónico</label></div>
        <div class="col-md-10 form-group">
            <input name="correo" value="<?=$configuracion['Correo']?>" class="form-control" type="email">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Dirección</label></div>
        <div class="col-md-4 form-group">
            <input name="direccion" value="<?=$configuracion['Direccion']?>" class="form-control" type="text">
        </div>

        <div class="col-md-2 form-group"><label>Teléfono</label></div>
        <div class="col-md-4 form-group">
            <input name="telefono" value="<?=$configuracion['Telefono']?>" class="form-control" type="number">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Usuario</label></div>
        <div class="col-md-4 form-group">
            <input name="usuario" value="<?=$configuracion['Usuario']?>" class="form-control" type="text">
        </div>

        <div class="col-md-2 form-group"><label>Contraseña</label></div>
        <div class="col-md-4 form-group">
            <input name="contraseña" type="password" placeholder="Vacío para mantener contraseña" class="form-control">
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <p class="text-danger"><b>IMPORTANTE:</b> Presionar F5 luego de subir una imagen para que tenga efecto en el navegador.</p>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('admin')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/pagina.js"></script>
<?= $this->endSection() ?>