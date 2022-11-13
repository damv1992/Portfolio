<?= $this->extend('plantilla/plantillaAdmin') ?>

<?= $this->section('estilosAdmin') ?>
<title><?=$configuracion['Nombre'].' - '.$titulo?></title>
<?= $this->endSection() ?>

<?= $this->section('contenidoAdmin') ?>
<h3><?=$titulo?></h3>
<form class="form">
    <!--
    Foto varchar(50)
    -->
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Frase</label></div>
        <div class="col-md-10 form-group">
            <input name="frase" value="<?=$acerca['Frase']?>" class="form-control" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Titulo</label></div>
        <div class="col-md-10 form-group">
            <input name="titulo" value="<?=$acerca['Titulo']?>" class="form-control" type="text" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Descripcion</label></div>
        <div class="col-md-10 form-group">
            <div id="herramientas"></div>
            <div name="descripcion" style="border-color: rgb(233, 233, 233);"><p><?=$acerca['Descripcion']?></p></div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Cumpleaños</label></div>
        <div class="col-md-10 form-group">
            <input name="cumpleaños" value="<?=$acerca['Cumpleaños']?>" class="form-control" type="date" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Ciudad</label></div>
        <div class="col-md-10 form-group">
            <input name="ciudad" value="<?=$acerca['Ciudad']?>" class="form-control" type="text" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Grado Académico</label></div>
        <div class="col-md-10 form-group">
            <select name="grado" class="form-control" required>
                <option value="">Seleccionar grado académico</option>
                <option value="Bachiller" <?php if ($acerca['Grado'] == 'Bachiller') { ?>selected <?php } ?>>
                    Bachiller</option>
                <option value="Universitario" <?php if ($acerca['Grado'] == 'Universitario') { ?>selected <?php } ?>>
                    Universitario</option>
                <option value="Licenciatura" <?php if ($acerca['Grado'] == 'Licenciatura') { ?>selected <?php } ?>>
                    Licenciatura</option>
                <option value="Maestría" <?php if ($acerca['Grado'] == 'Maestría') { ?>selected <?php } ?>>
                    Maestría</option>
                <option value="Doctorado" <?php if ($acerca['Grado'] == 'Doctorado') { ?>selected <?php } ?>>
                    Doctorado</option>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Matrícula profesional</label></div>
        <div class="col-md-10 form-group">
            <input name="matricula" value="<?=$acerca['Matricula']?>" class="form-control" type="number" required>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Freelance</label></div>
        <div class="col-md-10 form-group">
            <input class="freelance form-check-input" type="checkbox" <?php if ($acerca['Freelance']) { ?>checked
                <?php } ?>>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-2 form-group"><label>Foto</label></div>
        <div class="col-md-10 form-group">
            <input class="form-control" type="file" name="imagen">
            <img id="verImagen" width="300" height="300"
                <?php if ($acerca['Foto']) { ?>src="<?=base_url($acerca['Foto'])?>" <?php } ?>>
        </div>
    </div>
    <div class="mt-3">
        <div class="mensaje"></div>
        <div class="d-flex justify-content-between">
            <a href="<?=site_url('admin')?>" class="btn btn-danger">Cancelar</a>
            <button class="btnGuardar btn btn-success">Guardar</button>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('scriptsAdmin') ?>
<script src="<?=base_url()?>/custom/js/acerca.js"></script>
<script>
    <?php if ($acerca['Foto']) { ?>
    $('#verImagen').show();
    <?php } ?>
</script>
<?= $this->endSection() ?>