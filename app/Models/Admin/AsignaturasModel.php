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
        'id_tipo_asignatura',
        'as_nombre',
        'as_abreviatura',
        'as_shortname',
        'as_curricular'
    ];

    public function existeAsignatura($nombre, $id_area)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_asignatura 
                                    WHERE as_nombre = '$nombre' 
                                      AND id_area = $id_area");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

}