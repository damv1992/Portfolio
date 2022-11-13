<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionModel extends Model
{
    protected $table = 'Configuracion';
    protected $allowedFields = ['Nombre', 'Profesiones', 'Icono', 'Fondo', 'Correo', 'Direccion', 'Telefono', 'Usuario', 'Contraseña'];
}