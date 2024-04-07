<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AsignaturasCursosModel extends Model
{

    protected $table      = 'sw_asignatura_curso';
    protected $primaryKey = 'id_asignatura_curso';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_lectivo',
        'id_curso',
        'id_asignatura',
        'ac_orden'
    ];

    public function existeAsociacion($id_curso, $id_asignatura, $id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_asignatura_curso 
                                    WHERE id_curso = $id_curso 
                                      AND id_asignatura = $id_asignatura
                                      AND id_periodo_lectivo = $id_periodo_lectivo");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function getNextOrderNumber($id_curso)
    {
        $query = $this->db->query("SELECT MAX(ac_orden) AS secuencial FROM sw_asignatura_curso WHERE id_curso = $id_curso");
        $asociacion = $query->getRow();

        return $asociacion == null ? 1 : $asociacion->secuencial + 1;
    }

    public function listarAsignaturasAsociadas($id_curso)
    {
        $asignaturas_cursos = $this->db->query("
            SELECT *
            FROM sw_asignatura_curso ac,
                 sw_curso c,
                 sw_especialidad e,   
                 sw_asignatura a 
            WHERE c.id_curso = ac.id_curso
              AND e.id_especialidad = c.id_especialidad 
              AND a.id_asignatura = ac.id_asignatura
              AND ac.id_curso = $id_curso 
            ORDER BY ac_orden              
        ");

        return $asignaturas_cursos->getResultObject();
    }

    public function actualizarOrden($id_asignatura_curso, $orden)
    {
        $data = [
            'ac_orden' => $orden
        ];

        $this->update($id_asignatura_curso, $data);
    }
}