<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ParalelosUsuariosModel extends Model
{

    protected $table      = 'sw_paralelo_tutor';
    protected $primaryKey = 'id_paralelo_tutor';

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
                                     FROM sw_paralelo_tutor 
                                    WHERE id_paralelo = $id_paralelo 
                                      AND id_periodo_lectivo = $id_periodo_lectivo");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function listarTutoresAsociados($id_periodo_lectivo)
    {
        $paralelos_tutores = $this->db->query("
            SELECT *
            FROM sw_paralelo_tutor pt,
                 sw_paralelo p,
                 sw_usuario u, 
                 sw_curso c,
                 sw_especialidad e   
            WHERE p.id_paralelo = pt.id_paralelo
              AND u.id_usuario = pt.id_usuario
              AND c.id_curso = p.id_curso
              AND e.id_especialidad = c.id_especialidad 
              AND pt.id_periodo_lectivo = $id_periodo_lectivo 
            ORDER BY pa_orden              
        ");

        return $paralelos_tutores->getResultObject();
    }

}