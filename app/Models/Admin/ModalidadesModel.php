<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ModalidadesModel extends Model
{

    protected $table      = 'sw_modalidad';
    protected $primaryKey = 'id_modalidad';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'mo_nombre',
        'mo_activo',
        'mo_orden'
    ];

    public function listarModalidades()
    {
        $modalidades = $this->db->query("SELECT * 
                                           FROM sw_modalidad
                                       ORDER BY mo_orden ASC");

        return $modalidades->getResult();
    }

    public function getNextOrderNumber()
    {
        $query = $this->db->query("SELECT MAX(mo_orden) AS secuencial FROM sw_modalidad");
        $modalidad = $query->getRow();

        return $modalidad == null ? 1 : $modalidad->secuencial + 1;
    }

    public function actualizarOrden($id_modalidad, $mo_orden)
    {
        $data = [
            'mo_orden' => $mo_orden
        ];

        $this->update($id_modalidad, $data);
    }
}
