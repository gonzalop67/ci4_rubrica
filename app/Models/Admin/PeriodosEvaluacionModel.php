<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PeriodosEvaluacionModel extends Model
{
    protected $table            = 'sw_periodo_evaluacion';
    protected $primaryKey       = 'id_periodo_evaluacion';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_periodo_lectivo',
        'id_tipo_periodo',
        'pe_nombre',
        'pe_abreviatura',
        'pe_ponderacion',
        'pe_orden'
    ];

    public function existeCampoPeriodoEvaluacion($campo, $nombre, $id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_periodo_evaluacion 
                                    WHERE $campo = '$nombre' 
                                      AND id_periodo_lectivo = $id_periodo_lectivo");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function existeRepetidoPeriodoEvaluacion($campo, $nombre, $id_periodo_lectivo, $id_periodo_evaluacion)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_periodo_evaluacion 
                                    WHERE $campo = '$nombre' 
                                      AND id_periodo_lectivo = $id_periodo_lectivo
                                      AND id_periodo_evaluacion <> $id_periodo_evaluacion");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function actualizarOrden($id_periodo_evaluacion, $orden)
    {
        $data = [
            'pe_orden' => $orden
        ];

        $this->update($id_periodo_evaluacion, $data);
    }
}
