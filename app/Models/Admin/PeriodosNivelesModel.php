<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PeriodosNivelesModel extends Model
{

    protected $table      = 'sw_periodo_nivel';
    protected $primaryKey = 'id_periodo_nivel';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_lectivo',
        'id_nivel_educacion'
    ];

    public function existeAsociacion($id_periodo_lectivo, $id_nivel_educacion)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_periodo_nivel 
                                    WHERE id_periodo_lectivo = $id_periodo_lectivo 
                                      AND id_nivel_educacion = $id_nivel_educacion");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function listarNivelesAsociados($id_periodo_lectivo)
    {
        $periodos_niveles = $this->db->query("
            SELECT *
            FROM sw_periodo_nivel pn,
                 sw_periodo_lectivo pl,
                 sw_modalidad mo,   
                 sw_nivel_educacion ne 
            WHERE ne.id_nivel_educacion = pn.id_nivel_educacion
              AND pl.id_periodo_lectivo = pn.id_periodo_lectivo 
              AND mo.id_modalidad = pl.id_modalidad
              AND pn.id_periodo_lectivo = $id_periodo_lectivo
        ");

        return $periodos_niveles->getResultObject();
    }
}