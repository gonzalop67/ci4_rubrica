<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TiposAporteModel extends Model
{

    protected $table      = 'sw_tipo_aporte';
    protected $primaryKey = 'id_tipo_aporte';

    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'ta_descripcion'
    ];

}