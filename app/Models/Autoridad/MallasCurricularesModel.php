<?php

namespace App\Models\Autoridad;

use CodeIgniter\Model;

class MallasCurricularesModel extends Model
{
    protected $table            = 'sw_malla_curricular';
    protected $primaryKey       = 'sw_malla_curricular';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_periodo_lectivo',
        'id_curso',
        'id_asignatura',
        'ma_horas_presenciales',
        'ma_horas_autonomas',
        'ma_horas_tutorias',
        'ma_subtotal'
    ];

}