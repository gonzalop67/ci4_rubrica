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
}
