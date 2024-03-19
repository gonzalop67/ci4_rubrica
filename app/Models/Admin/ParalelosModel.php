<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ParalelosModel extends Model
{

    protected $table      = 'sw_paralelo';
    protected $primaryKey = 'id_paralelo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_curso',
        'id_periodo_lectivo',
        'id_jornada',
        'pa_nombre',
        'cu_orden'
    ];

    public function getCurso($id_paralelo)
    {
        $registro = $this->db->query("SELECT cu.cu_nombre 
                                        FROM sw_paralelo pa, 
                                             sw_curso cu
                                       WHERE cu.id_curso = pa.id_curso 
                                         AND id_paralelo = $id_paralelo");

        return $registro->getRow()->cu_nombre;
    }

    public function getNextOrderNumber($id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT MAX(pa_orden) AS secuencial FROM sw_paralelo WHERE id_periodo_lectivo = $id_periodo_lectivo");
        $paralelo = $query->getRow();

        return $paralelo == null ? 1 : $paralelo->secuencial + 1;
    }

    public function actualizarOrden($id_paralelo, $orden)
    {
        $data = [
            'pa_orden' => $orden
        ];

        $this->update($id_paralelo, $data);
    }
}
