<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UsuariosModel extends Model
{

    protected $table      = 'sw_usuario';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'us_titulo',
        'us_apellidos',
        'us_nombres',
        'us_shortname',
        'us_fullname',
        'us_login',
        'us_password',
        'us_foto',
        'us_genero',
        'us_activo'
    ];

}