<?php
$color = '#2E74B6';
setlocale(LC_TIME, 'es_VE.UTF-8','esp');
$cumpleaños = strftime('%e de %B de %Y', strtotime($acerca['Cumpleaños']));
/*
use App\Models\CapturasModel;
$capturas = new CapturasModel();
*/
?>
<style>
    div {
        display: inline-block;
        font-size: 11px;
    }

    .resumen {
        width: 100%;
        text-align: left;
        vertical-align: top;
    }

    .izquierda {
        float: left;
        background-color: <?=$color?>;
        width: 45%;
        height: 23cm;
    }

    .derecha {
        float: left;
        width: 55%;
        height: 23cm;
    }

    h2,
    h3 {
        color: white;
    }

    .texto {
        padding: 10px;
    }
</style>
<center>
    <h1 style="color: <?=$color?>;"><u>CURRICULUM VITAE</u></h1>
</center>
<div class="resumen">
    <div class="izquierda">
        <div class="texto">
            <h2><?=mb_strtoupper($configuracion['Nombre'])?></h2>
            <h3><?=mb_strtoupper($configuracion['Profesiones'])?></h3>
            <p><?=$acerca['Descripcion']?></p>
            <p><strong>Teléfono: </strong><?=$configuracion['Telefono']?></p>
            <p><strong>E-mail: </strong><?=$configuracion['Correo']?></p>
            <p><strong>Nacimiento: </strong><?=$cumpleaños?></p>
            <?php if (count($habilidadess)) { ?><h3>HABILIDADES</h3><?php } ?>
            <ul>
                <?php foreach ($habilidadess as $habilidad) { ?>
                <li><?=$habilidad['Habilidad']?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="derecha">
        <div class="texto">
            <?php if (count($experienciass)) { ?><h2 style="color: <?=$color?>;"><u>EXPERIENCIA LABORAL</u></h2>
            <?php } ?>
            <ul>
                <?php foreach ($experienciass as $experiencia) { ?>
                <li><strong><?=$experiencia['Cargo']?> EN <?=mb_strtoupper($experiencia['Empresa'])?> DE
                        <?=mb_strtoupper($experiencia['Ciudad'])?></strong></li>
                <?php
                    $inicio = date('d/m/Y', strtotime($experiencia['FechaInicio']));
                    if ($experiencia['Presente']) $fin = 'presente';
                    else $fin = date('d/m/Y', strtotime($experiencia['FechaFin']));
                ?>
                Del <?=$inicio?> al <?=$fin?>
                <br>Funciones: <?=$experiencia['Funciones']?>
                <?php } ?>
            </ul>

            <?php if (count($educacioness)) { ?><h2 style="color: <?=$color?>;"><u>FORMACION ACADEMICA</u></h2>
            <?php } ?>
            <ul>
                <?php foreach ($educacioness as $educacion) { ?>
                <li><strong><?=$educacion['Educacion']?></strong></li>
                <?=mb_strtoupper($educacion['Institucion'])?>
                <?php
                    $inicio = date('d/m/Y', strtotime($educacion['FechaInicio']));
                    if ($educacion['Presente']) $fin = 'presente';
                    else $fin = date('d/m/Y', strtotime($educacion['FechaFin']));
                ?>
                <br><?=$inicio?> - <?=$fin?>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<div>
</div>