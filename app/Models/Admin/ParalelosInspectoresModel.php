<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ParalelosInspectoresModel extends Model
{

    protected $table      = 'sw_paralelo_inspector';
    protected $primaryKey = 'id_paralelo_inspector';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_lectivo',
        'id_paralelo',
        'id_usuario'
    ];

    public function existeAsociacion($id_paralelo, $id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_paralelo_inspector 
                                    WHERE id_paralelo = $id_paralelo 
                                      AND id_periodo_lectivo = $id_periodo_lectivo");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function listarInspectoresAsociados($id_periodo_lectivo)
    {
        $paralelos_inspectores = $this->db->query("
            SELECT *
            FROM sw_paralelo_inspector pi,
                 sw_paralelo p,
                 sw_curso c,
                 sw_especialidad e,   
                 sw_usuario u 
            WHERE p.id_paralelo = pi.id_paralelo
              AND c.id_curso = p.id_paralelo
              AND e.id_especialidad = c.id_especialidad 
              AND u.id_usuario = pi.id_usuario
              AND pi.id_periodo_lectivo = $id_periodo_lectivo 
            ORDER BY pa_orden              
        ");

        return $paralelos_inspectores->getResultObject();
    }

}