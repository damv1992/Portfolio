<?php

namespace App\Models;

use CodeIgniter\Model;

class EducacionesModel extends Model
{
    protected $table = 'Educaciones';
    protected $primarykey = 'IdEducacion';
    protected $allowedFields = ['IdEducacion', 'Educacion', 'FechaInicio', 'FechaFin', 'Presente', 'Institucion', 'Ciudad'];
}