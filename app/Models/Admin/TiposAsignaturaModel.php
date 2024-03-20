<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TiposAsignaturaModel extends Model
{

    protected $table      = 'sw_tipo_asignatura';
    protected $primaryKey = 'id_tipo_asignatura';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'ta_descripcion'
    ];

}