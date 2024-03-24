<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class InstitucionModel extends Model
{

    protected $table      = 'sw_institucion';
    protected $primaryKey = 'id_institucion';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'in_nombre', 
        'in_direccion', 
        'in_telefono', 
        'in_nom_rector', 
        'in_nom_vicerrector', 
        'in_nom_secretario', 
        'in_url', 
        'in_logo', 
        'in_amie', 
        'in_ciudad', 
        'in_copiar_y_pegar'
    ];

    public function actualizar_copiar_y_pegar($in_copiar_y_pegar)
    {
        $data = [
            'in_copiar_y_pegar' => $in_copiar_y_pegar
        ];

        $this->update(1, $data);
    }
}