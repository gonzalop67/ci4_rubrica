<?php

namespace App\Controllers\Autoridad;

use App\Controllers\BaseController;

use App\Models\Admin\CursosModel;
use App\Models\Admin\AsignaturasModel;
use App\Models\Autoridad\MallasCurricularesModel;

class Mallas_curriculares extends BaseController
{
    protected $cursoModel,
        $asignaturaModel,
        $mallaCurricularModel;

    public function __construct()
    {
        $this->cursoModel = new CursosModel();
        $this->asignaturaModel = new AsignaturasModel();
        $this->mallaCurricularModel = new MallasCurricularesModel();
    }

    public function index()
    {
        return view('Autoridad/Mallas_curriculares/index', [
            'cursos' => $this->cursoModel
                ->join(
                    'sw_especialidad',
                    'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
                )
                ->join(
                    'sw_nivel_educacion',
                    'sw_nivel_educacion.id_nivel_educacion = sw_especialidad.id_nivel_educacion'
                )->orderBy('cu_orden')
                ->findAll()
        ]);
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {
            $asignaturas = $this->cursoModel
                ->select(
                    'sw_asignatura.*'
                )
                ->join(
                    'sw_asignatura_curso',
                    'sw_curso.id_curso = sw_asignatura_curso.id_curso')
                ->join(
                    'sw_asignatura',
                    'sw_asignatura.id_asignatura = sw_asignatura_curso.id_asignatura'
                )
                ->where('sw_asignatura_curso.id_curso', $this->request->getVar('id_curso'))
                ->orderBy('ac_orden')
                ->findAll();
            $msg = [
                'data' => view('Autoridad/Mallas_curriculares/modalInsert', [
                    'asignaturas' => $asignaturas
                ])
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
