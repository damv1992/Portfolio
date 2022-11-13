<?php

namespace App\Models;

use CodeIgniter\Model;

class AcercaModel extends Model
{
    protected $table = 'Acerca';
    protected $allowedFields = ['Frase', 'Titulo', 'Descripcion', 'Cumpleaños', 'Ciudad', 'Grado', 'Matricula', 'Freelance', 'Foto'];
}