<?php

namespace App\Models;

use CodeIgniter\Model;

class ExperienciasModel extends Model
{
    protected $table = 'Experiencias';
    protected $primarykey = 'IdExperiencia';
    protected $allowedFields = ['IdExperiencia', 'Cargo', 'FechaInicio', 'FechaFin', 'Presente', 'Empresa', 'Ciudad', 'Funciones'];
}