<?php

namespace App\Models;

use CodeIgniter\Model;

class HabilidadesModel extends Model
{
    protected $table = 'Habilidades';
    protected $primarykey = 'IdHabilidad';
    protected $allowedFields = ['IdHabilidad', 'Habilidad', 'Porcentaje'];
}