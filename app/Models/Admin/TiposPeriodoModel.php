<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TiposPeriodoModel extends Model
{

    protected $table      = 'sw_tipo_periodo';
    protected $primaryKey = 'id_tipo_periodo';

    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'tp_descripcion'
    ];

}