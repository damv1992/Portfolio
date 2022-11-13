<?php

namespace App\Models;

use CodeIgniter\Model;

class RedesSocialesModel extends Model
{
    protected $table = 'Sociales';
    protected $primarykey = 'IdRedSocial';
    protected $allowedFields = ['IdRedSocial', 'Icono', 'Enlace'];
}