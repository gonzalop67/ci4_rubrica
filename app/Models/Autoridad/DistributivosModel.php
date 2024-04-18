<?php

namespace App\Models\Autoridad;

use CodeIgniter\Model;

class DistributivosModel extends Model
{
    protected $table            = 'sw_distributivo';
    protected $primaryKey       = 'id_distributivo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_periodo_lectivo',
        'id_malla_curricular',
        'id_paralelo',
        'id_asignatura',
        'id_usuario'
    ];

    public function existeAsociacion($id_paralelo, $id_asignatura)
    {
        $query = $this->db->query("SELECT * FROM sw_distributivo WHERE id_paralelo = $id_paralelo AND id_asignatura = $id_asignatura");
        $num_rows = count($query->getResultObject());
        return $num_rows > 0;
    }
}
