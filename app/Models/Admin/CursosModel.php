<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class CursosModel extends Model
{

    protected $table      = 'sw_curso';
    protected $primaryKey = 'id_curso';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_especialidad',
        'id_curso_superior',
        'cu_nombre',
        'cu_shortname',
        'cu_abreviatura',
        'cu_orden',
        'quien_inserta_comp'
    ];

    public function getEspecialidad($id_curso)
    {
        $registro = $this->db->query("SELECT es.es_nombre 
                                        FROM sw_especialidad es, 
                                             sw_curso cu
                                       WHERE es.id_especialidad = cu.id_especialidad 
                                         AND id_curso = $id_curso");

        return $registro->getRow()->es_nombre;
    }
}
