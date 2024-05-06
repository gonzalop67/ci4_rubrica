<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ParalelosModel extends Model
{

    protected $table      = 'sw_paralelo';
    protected $primaryKey = 'id_paralelo';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = [
        'id_periodo_lectivo',
        'id_curso',
        'id_periodo_lectivo',
        'id_jornada',
        'pa_nombre',
        'pa_orden'
    ];

    public function getCurso($id_paralelo)
    {
        $registro = $this->db->query("SELECT cu.cu_nombre 
                                        FROM sw_paralelo pa, 
                                             sw_curso cu
                                       WHERE cu.id_curso = pa.id_curso 
                                         AND id_paralelo = $id_paralelo");

        return $registro->getRow()->cu_nombre;
    }

    public function getCursoId($id_paralelo)
    {
        $CursoId = $this->db->query("
            SELECT id_curso 
            FROM sw_paralelo
            WHERE id_paralelo = $id_paralelo
        ");

        $cursoId = $CursoId->getRow();

        return $cursoId->id_curso;
    }

    public function getNextOrderNumber($id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT MAX(pa_orden) AS secuencial FROM sw_paralelo WHERE id_periodo_lectivo = $id_periodo_lectivo");
        $paralelo = $query->getRow();

        return $paralelo->secuencial == null ? 1 : $paralelo->secuencial + 1;
    }

    public function actualizarOrden($id_paralelo, $orden)
    {
        $data = [
            'pa_orden' => $orden
        ];

        $this->update($id_paralelo, $data);
    }

    public function existeParalelo($nombre, $id_curso, $id_periodo_lectivo)
    {
        $query = $this->db->query("SELECT * 
                                     FROM sw_paralelo 
                                    WHERE pa_nombre = '$nombre' 
                                      AND id_curso = $id_curso 
                                      AND id_periodo_lectivo = $id_periodo_lectivo");

        $num_rows = count($query->getResultObject());

        return $num_rows > 0;
    }

    public function crearCierresPeriodoLectivo($id_periodo_lectivo)
    {
        $sql = "CALL sp_crear_cierres_periodo_lectivo(?)";
        $result = $this->db->query($sql, [$id_periodo_lectivo]);

        if ($result) {
            return true;
        }

        return false;
    }
    
}
