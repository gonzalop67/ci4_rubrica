<?php

namespace App\Models\Secretaria;

use CodeIgniter\Model;

class EstudiantesPeriodoLectivoModel extends Model
{
    protected $table            = 'sw_estudiante_periodo_lectivo';
    protected $primaryKey       = 'id_estudiante_periodo_lectivo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_estudiante',
        'id_periodo_lectivo',
        'id_paralelo',
        'es_estado',
        'es_retirado',
        'nro_matricula',
        'activo'
    ];

    public function getMaxNroMatricula($id_periodo_lectivo)
    {
        $maxNroMatricula = $this->db->query("
            SELECT MAX(nro_matricula) AS maxNroMatricula
            FROM sw_estudiante_periodo_lectivo
            WHERE id_periodo_lectivo = $id_periodo_lectivo
        ");

        if ($maxNroMatricula) {
            $max = $maxNroMatricula->getRow();
            $maxNroMatricula = $max->maxNroMatricula;
        } else {
            $maxNroMatricula = 0;
        }
        
        return $maxNroMatricula;
    }
}