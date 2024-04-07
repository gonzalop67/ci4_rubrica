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

    public function existeCampoAporteEvaluacion($campo, $nombre, $id_periodo_evaluacion)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_aporte_evaluacion 
                                    WHERE $campo = '$nombre' 
                                      AND id_periodo_evaluacion = $id_periodo_evaluacion");

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

    public function getNextOrderNumber($id_periodo_evaluacion)
    {
        $query = $this->db->query("SELECT MAX(ap_orden) AS secuencial FROM sw_aporte_evaluacion WHERE id_periodo_evaluacion = $id_periodo_evaluacion");
        $aporte = $query->getRow();

        return $aporte == null ? 1 : $aporte->secuencial + 1;
    }

    public function actualizarOrden($id_aporte_evaluacion, $orden)
    {
        $data = [
            'ap_orden' => $orden
        ];

        $this->update($id_aporte_evaluacion, $data);
    }

    public function getAportesEvaluacion($id_periodo_evaluacion)
    {
        $consulta = $this->db->query("SELECT id_aporte_evaluacion, ap_nombre 
                                     FROM sw_aporte_evaluacion 
                                    WHERE id_periodo_evaluacion = $id_periodo_evaluacion 
                                    ORDER BY ap_orden")
            ->getResultObject();

        $cadena = "";

        foreach ($consulta as $row) {
            $code = $row->id_aporte_evaluacion;
            $name = $row->ap_nombre;
            $cadena .= "<option value=\"$code\">$name</option>\n";
        }

        return $cadena;
    }
}
