<?php

namespace App\Models;

use CodeIgniter\Model;

class CursosModel extends Model
{
    protected $table = 'Cursos';
    protected $primarykey = 'IdCurso';
    protected $allowedFields = ['IdCurso', 'Curso', 'Institucion', 'FechaInicio', 'FechaFin', 'Presente'];
}