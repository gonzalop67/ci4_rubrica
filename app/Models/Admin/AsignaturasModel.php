<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AsignaturasModel extends Model
{

    protected $table      = 'sw_asignatura';
    protected $primaryKey = 'id_asignatura';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_area',
        'id_tipo_asingatura',
        'as_nombre',
        'as_abreviatura',
        'as_shortname',
        'as_curricular'
    ];

}