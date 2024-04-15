<?php

namespace App\Models\Autoridad;

use CodeIgniter\Model;

class MallasCurricularesModel extends Model
{
    protected $table            = 'sw_malla_curricular';
    protected $primaryKey       = 'id_malla_curricular';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_periodo_lectivo',
        'id_curso',
        'id_asignatura',
        'ma_horas_presenciales',
        'ma_horas_autonomas',
        'ma_horas_tutorias',
        'ma_subtotal'
    ];

    public function existeAsociacion($id_curso, $id_asignatura)
    {
        $query = $this->db->query("SELECT * FROM sw_malla_curricular WHERE id_curso = $id_curso AND id_asignatura = $id_asignatura");
        $num_rows = count($query->getResultObject());
        return $num_rows > 0;
    }

    public function listarAsignaturasAsociadas($id_curso)
    {
        $query = $this->db->query("SELECT m.*, 
                   as_nombre, 
                   cu_nombre,
                   ac_orden 
              FROM sw_malla_curricular m, 
                   sw_curso c, 
                   sw_asignatura_curso ac, 
                   sw_asignatura a 
             WHERE c.id_curso = m.id_curso 
               AND c.id_curso = ac.id_curso 
               AND a.id_asignatura = m.id_asignatura 
               AND m.id_asignatura = ac.id_asignatura 
               AND m.id_curso = $id_curso
             ORDER BY ac_orden");
        $num_rows = count($query->getResultObject());
        $cadena = "";
        $suma_horas = 0;
        if ($num_rows > 0) {
            foreach ($query->getResult() as $row) {
                $cadena .= "<tr>\n";
                $id = $row->id_malla_curricular;
                $presenciales = $row->ma_horas_presenciales;
                $autonomas = $row->ma_horas_autonomas;
                $tutorias = $row->ma_horas_tutorias;
                $suma_horas = $suma_horas + $presenciales + $tutorias;
                $cadena .= "<td>$id</td>\n";
                $cadena .= "<td>" . $row->as_nombre . "</td>\n";
                $cadena .= "<td>" . $row->cu_nombre . "</td>\n";
                $cadena .= "<td>$presenciales</td>\n";
                $cadena .= "<td>$autonomas</td>\n";
                $cadena .= "<td>$tutorias</td>\n";
                $cadena .= "<td>\n";
                $cadena .= "<div class=\"btn-group\">\n";
                $cadena .= "<a href='" . base_url(route_to('mallas_curriculares_edit', $row->id_malla_curricular)) . "' onclick='edit(event, this, " . $row->id_malla_curricular . ")' class='btn btn-warning btn-sm item-edit' title='Editar'><span class='fa fa-pencil'></span></a>";
                $cadena .= "</div>\n";
                $cadena .= "</td>\n";
                $cadena .= "</tr>\n";
            }
        } else {
            $cadena .= "<tr>\n";
            $cadena .= "<td colspan='7' align='center'>No se han definido items asociados a este curso...</td>\n";
            $cadena .= "</tr>\n";
        }
        $datos = array(
            'cadena' => $cadena,
            'total_horas' => $suma_horas
        );
        return json_encode($datos);
    }
}
