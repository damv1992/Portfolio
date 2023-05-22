<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitantesModel extends Model
{
    protected $table = 'Visitantes';
    protected $primarykey = 'Ip';
    protected $allowedFields = ['Ip', 'Perteneciente', 'FechaVisita'];
}