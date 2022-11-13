<?php

namespace App\Models;

use CodeIgniter\Model;

class CapturasModel extends Model
{
    protected $table = 'Capturas';
    protected $primarykey = 'IdCaptura';
    protected $allowedFields = ['IdCaptura', 'Captura', 'Proyecto'];
}