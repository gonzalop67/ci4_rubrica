<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class EspecialidadesModel extends Model
{

    protected $table      = 'sw_especialidad';
    protected $primaryKey = 'id_especialidad';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_nivel_educacion',
        'es_nombre',
        'es_figura',
        'es_abreviatura',
        'es_orden'
    ];

}