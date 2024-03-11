<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class NivelesEducacionModel extends Model
{

    protected $table      = 'sw_nivel_educacion';
    protected $primaryKey = 'id_nivel_educacion';

    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'nombre',
        'es_bachillerato',
        'orden'
    ];

    public function getNextOrderNumber()
    {
        $query = $this->db->query("SELECT MAX(orden) AS secuencial FROM sw_nivel_educacion");
        $nivel_educacion = $query->getRow();

        return $nivel_educacion == null ? 1 : $nivel_educacion->secuencial + 1;
    }

    public function actualizarOrden($id_nivel_educacion, $orden)
    {
        $data = [
            'orden' => $orden
        ];

        $this->update($id_nivel_educacion, $data);
    }
}