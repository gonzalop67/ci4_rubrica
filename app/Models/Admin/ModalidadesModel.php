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
        'mo_activo'
    ];

    public function listarModalidades()
    {
        $modalidades = $this->db->query("SELECT * 
                                           FROM sw_modalidad
                                       ORDER BY mo_orden ASC");

        return $modalidades->getResult();
    }
}