<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class InsumosEvaluacionModel extends Model
{
    protected $table            = 'sw_rubrica_evaluacion';
    protected $primaryKey       = 'id_rubrica_evaluacion';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_aporte_evaluacion',
        'id_tipo_asignatura',
        'ru_nombre',
        'ru_descripcion',
        'ru_abreviatura'
    ];

}