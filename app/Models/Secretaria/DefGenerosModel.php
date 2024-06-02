<?php

namespace App\Models\Secretaria;

use CodeIgniter\Model;

class DefGenerosModel extends Model
{
    protected $table            = 'sw_def_genero';
    protected $primaryKey       = 'id_def_genero';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'dg_nombre',
        'dg_abreviatura'
    ];

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM sw_def_genero ORDER BY dg_nombre");
        $num_rows = count($query->getResultObject());
        $cadena = "";
        if ($num_rows > 0) {
            foreach ($query->getResult() as $row) {
                $cadena .= "<option value='". $row->id_def_genero . "'>" . $row->dg_nombre . "</option>";
            }
        }
        return $cadena;
    }
}