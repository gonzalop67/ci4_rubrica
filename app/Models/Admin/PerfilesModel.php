<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PerfilesModel extends Model
{

    protected $table      = 'sw_perfil';
    protected $primaryKey = 'id_perfil';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'pe_nombre'
    ];

}