<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class UsuariosPerfilesModel extends Model
{

    protected $table      = 'sw_usuario_perfil';

    protected $returnType = 'object';

    protected $allowedFields = ['id_usuario', 'id_perfil'];

}