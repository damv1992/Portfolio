<?php

namespace App\Models;

use CodeIgniter\Model;

class ProyectosModel extends Model
{
    protected $table = 'Proyectos';
    protected $primarykey = 'IdProyecto';
    protected $allowedFields = ['IdProyecto', 'Titulo', 'Categoria', 'Enlace', 'Cliente', 'Fecha', 'Descripcion'];
}