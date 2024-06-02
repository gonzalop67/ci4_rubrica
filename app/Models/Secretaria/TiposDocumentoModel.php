<?php

namespace App\Models\Secretaria;

use CodeIgniter\Model;

class TiposDocumentoModel extends Model
{
    protected $table            = 'sw_tipo_documento';
    protected $primaryKey       = 'id_tipo_documento';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'td_nombre'
    ];

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM sw_tipo_documento ORDER BY id_tipo_documento");
        $num_rows = count($query->getResultObject());
        $cadena = "";
        if ($num_rows > 0) {
            foreach ($query->getResult() as $row) {
                $cadena .= "<option value='". $row->id_tipo_documento . "'>" . $row->td_nombre . "</option>";
            }
        }
        return $cadena;
    }
}