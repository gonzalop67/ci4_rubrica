<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class subPeriodosPeriodosModel extends Model
{

    protected $table      = 'sw_periodo_lectivo_sub_periodo';

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_sub_periodo_evaluacion',
        'id_periodo_lectivo'
    ];

}
