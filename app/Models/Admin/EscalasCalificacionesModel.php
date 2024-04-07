<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class EscalasCalificacionesModel extends Model
{

    protected $table      = 'sw_escala_calificaciones';
    protected $primaryKey = 'id_escala_calificaciones';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_lectivo',
        'ec_cualitativa',
        'ec_cuantitativa',
        'ec_nota_minima',
        'ec_nota_maxima',
        'ec_orden',
        'ec_equivalencia'
    ];

    public function getNextOrderNumber($id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT MAX(ec_orden) AS secuencial FROM sw_escala_calificaciones WHERE id_periodo_lectivo = $id_periodo_lectivo");
        $escala = $query->getRow();

        return $escala == null ? 1 : $escala->secuencial + 1;
    }

    public function actualizarOrden($id_escala_calificaciones, $orden)
    {
        $data = [
            'ec_orden' => $orden
        ];

        $this->update($id_escala_calificaciones, $data);
    }
}