<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class EspecialidadesModel extends Model
{

    protected $table      = 'sw_especialidad';
    protected $primaryKey = 'id_especialidad';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_nivel_educacion',
        'es_nombre',
        'es_figura',
        'es_abreviatura',
        'es_orden'
    ];

    public function getNivelEducacion($id_especialidad)
    {
        $registro = $this->db->query("SELECT ni.nombre 
                                        FROM sw_nivel_educacion ni,
                                             sw_especialidad es
                                       WHERE ni.id_nivel_educacion = es.id_nivel_educacion 
                                         AND id_especialidad = $id_especialidad");

        return $registro->getRow()->nombre;
    }

    public function getNextOrderNumber()
    {
        $query = $this->db->query("SELECT MAX(es_orden) AS secuencial FROM sw_especialidad");
        $especialidad = $query->getRow();

        return $especialidad == null ? 1 : $especialidad->secuencial + 1;
    }

    public function actualizarOrden($id_especialidad, $orden)
    {
        $data = [
            'es_orden' => $orden
        ];

        $this->update($id_especialidad, $data);
    }
}