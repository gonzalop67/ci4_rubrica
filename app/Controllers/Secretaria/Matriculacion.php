<?php

namespace App\Controllers\Secretaria;

use App\Controllers\BaseController;
use App\Models\Admin\ParalelosModel;
use App\Models\Secretaria\DefGenerosModel;
use App\Models\Secretaria\DefNacionalidadesModel;
use App\Models\Secretaria\EstudiantesModel;
use App\Models\Secretaria\TiposDocumentoModel;

class Matriculacion extends BaseController
{
    private $paraleloModel;
    private $estudianteModel;
    private $defGenerosModel;
    private $tiposDocumentoModel;
    private $defNacionalidadesModel;

    public function __construct()
    {
        $this->paraleloModel = new ParalelosModel();
        $this->estudianteModel = new EstudiantesModel();
        $this->defGenerosModel = new DefGenerosModel();
        $this->tiposDocumentoModel = new TiposDocumentoModel();
        $this->defNacionalidadesModel = new DefNacionalidadesModel();
    }

    public function index()
    {
        $paralelos = $this->paraleloModel
            ->join(
                'sw_curso',
                'sw_curso.id_curso = sw_paralelo.id_curso'
            )
            ->join(
                'sw_especialidad',
                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
            )
            ->join(
                'sw_jornada',
                'sw_jornada.id_jornada = sw_paralelo.id_jornada'
            )
            ->where('id_periodo_lectivo', session('id_periodo_lectivo'))
            ->orderBy('pa_orden')
            ->findAll();

        return view('Secretaria/Matriculacion/index', [
            'paralelos' => $paralelos
        ]);
    }

    public function show()
    {
        $id_paralelo = $_POST['id_paralelo'];

        echo $this->estudianteModel->listarEstudiantesParalelo($id_paralelo);
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {

            $tipos_documentos =
                $this->tiposDocumentoModel
                ->orderBy('id_tipo_documento')
                ->findAll();

            $def_generos =
                $this->defGenerosModel
                ->orderBy('dg_nombre')
                ->findAll();

            $def_nacionalidades =
                $this->defNacionalidadesModel
                ->orderBy('id_def_nacionalidad')
                ->findAll();

            $data = [
                'def_generos' => $def_generos,
                'tipos_documentos' => $tipos_documentos,
                'def_nacionalidades' => $def_nacionalidades
            ];

            $msg = [
                'data' => view('Secretaria/Matriculacion/modalInsert', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
