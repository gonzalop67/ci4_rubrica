<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PeriodosLectivosModel extends Model
{

    protected $table      = 'sw_periodo_lectivo';
    protected $primaryKey = 'id_periodo_lectivo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_estado', 
        'id_modalidad',
        'pe_anio_inicio',
        'pe_anio_fin',
        'pe_fecha_inicio',
        'pe_fecha_fin',
        'pe_nota_minima',
        'pe_nota_aprobacion'
    ];

    public function listarPeriodosLectivos()
    {
        $periodos_lectivos = $this->db->query("SELECT p.*,
                                                      pe_descripcion, 
                                                      mo_nombre 
                                                 FROM sw_periodo_lectivo p, 
                                                      sw_periodo_estado pe, 
                                                      sw_modalidad m 
                                                WHERE pe.id_periodo_estado = p.id_periodo_estado 
                                                  AND m.id_modalidad = p.id_modalidad 
                                                ORDER BY mo_orden ASC,
                                                         pe_fecha_inicio DESC");

        return $periodos_lectivos->getResult();
    }

    public function listarPeriodosPorModalidad($id_modalidad)
    {
        $periodos_lectivos = $this->db->query("SELECT p.*, 
                                                      pe_descripcion 
                                                 FROM sw_periodo_lectivo p, 
                                                      sw_periodo_estado pe 
                                                WHERE pe.id_periodo_estado = p.id_periodo_estado 
                                                  AND id_modalidad = $id_modalidad ORDER BY pe_fecha_inicio DESC");

        return $periodos_lectivos->getResult();
    }

    public function obtenerMaxAnioInicio()
    {
        $registro = $this->db->query("SELECT MAX(pe_anio_inicio) AS max_anio_inicio FROM sw_periodo_lectivo");

        return $registro->getRow()->max_anio_inicio;
    }
}