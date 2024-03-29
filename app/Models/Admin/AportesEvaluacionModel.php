<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AportesEvaluacionModel extends Model
{
    protected $table            = 'sw_aporte_evaluacion';
    protected $primaryKey       = 'id_aporte_evaluacion';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_periodo_evaluacion',
        'id_tipo_aporte',
        'ap_nombre',
        'ap_descripcion',
        'ap_abreviatura',
        'ap_tipo',
        'ap_estado',
        'ap_fecha_apertura',
        'ap_fecha_cierre',
        'ap_ponderacion',
        'ap_orden'
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
