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
        'es_bach_tecnico',
        'es_intensivo'
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

    public function getFigura($id_curso)
    {
        $registro = $this->db->query("SELECT es.es_figura 
                                        FROM sw_especialidad es, 
                                             sw_curso cu
                                       WHERE es.id_especialidad = cu.id_especialidad 
                                         AND id_curso = $id_curso");

        return $registro->getRow()->es_figura;
    }

    public function existeCurso($nombre, $id_especialidad)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_curso 
                                    WHERE cu_nombre = '$nombre' 
                                      AND id_especialidad = $id_especialidad");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function getNextOrderNumber()
    {
        $query = $this->db->query("SELECT MAX(cu_orden) AS secuencial FROM sw_curso");
        $curso = $query->getRow();

        return $curso == null ? 1 : $curso->secuencial + 1;
    }

    public function actualizarOrden($id_curso, $orden)
    {
        $data = [
            'cu_orden' => $orden
        ];

        $this->update($id_curso, $data);
    }
}
