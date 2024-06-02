<?php

namespace App\Models\Secretaria;

use CodeIgniter\Model;

class DefNacionalidadesModel extends Model
{
    protected $table            = 'sw_def_nacionalidad';
    protected $primaryKey       = 'id_def_nacionalidad';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'dn_nombre'
    ];

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM sw_def_nacionalidad ORDER BY id_def_nacionalidad");
        $num_rows = count($query->getResultObject());
        $cadena = "";
        if ($num_rows > 0) {
            foreach ($query->getResult() as $row) {
                $cadena .= "<option value='". $row->id_def_nacionalidad . "'>" . $row->dn_nombre . "</option>";
            }
        }
        return $cadena;
    }
}