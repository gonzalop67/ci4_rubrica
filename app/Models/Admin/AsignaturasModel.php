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

    public function listarAsignaturasPorParalelo($id_paralelo)
    {
        $asignaturas_cursos = $this->db->query("
            SELECT a.*
            FROM sw_asignatura_curso ac,
                 sw_paralelo p, 
                 sw_curso c,   
                 sw_asignatura a 
            WHERE c.id_curso = ac.id_curso  
              AND a.id_asignatura = ac.id_asignatura
              AND c.id_curso = p.id_curso 
              AND p.id_paralelo = $id_paralelo 
            ORDER BY ac_orden              
        ");

        return $asignaturas_cursos->getResultObject();
    }
}