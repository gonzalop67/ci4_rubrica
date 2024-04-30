<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class CierrePeriodosModel extends Model
{

    protected $table      = 'sw_aporte_paralelo_cierre';
    protected $primaryKey = 'id_aporte_paralelo_cierre';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_aporte_evaluacion', 
        'id_paralelo', 
        'ap_fecha_apertura', 
        'ap_fecha_cierre', 
        'ap_estado'
    ];

    public function getCierresPeriodos($id_periodo_lectivo)
    {
        $query = $this->db->query("
            SELECT ac.*, 
                   ap_nombre, 
                   cu_nombre,
                   pa_nombre,
                   es_figura,
                   jo_nombre 
              FROM sw_aporte_paralelo_cierre ac,
                   sw_aporte_evaluacion ap,
                   sw_periodo_evaluacion pe,
                   sw_tipo_aporte ta, 
                   sw_paralelo pa,
                   sw_curso cu,
                   sw_especialidad es,
                   sw_jornada jo 
             WHERE ap.id_aporte_evaluacion = ac.id_aporte_evaluacion 
               AND pe.id_periodo_evaluacion = ap.id_periodo_evaluacion
               AND ta.id_tipo_aporte = ap.id_tipo_aporte
               AND pa.id_paralelo = ac.id_paralelo
               AND cu.id_curso = pa.id_curso
               AND es.id_especialidad = cu.id_especialidad
               AND jo.id_jornada = pa.id_jornada
               AND pa.id_periodo_lectivo = $id_periodo_lectivo 
             ORDER BY pa_orden, 
                      pe.id_periodo_evaluacion, 
                      ta.id_tipo_aporte, 
                      ap.id_aporte_evaluacion
        ");

        return $query->getResultObject();
    }
}