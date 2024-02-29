<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MenusPerfilesModel extends Model
{

    protected $table      = 'sw_menu_perfil';

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_menu',
        'id_perfil'
    ];

}
