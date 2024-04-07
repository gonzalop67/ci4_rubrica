<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AsignaturasCursosModel;
use App\Models\Admin\AsignaturasModel;
use App\Models\Admin\CursosModel;

class Asignaturas_cursos extends BaseController
{
    private $cursoModel;
    private $asignaturaModel;
    private $asignaturaCursoModel;

    public function __construct()
    {
        $this->cursoModel = new CursosModel();
        $this->asignaturaModel = new AsignaturasModel();
        $this->asignaturaCursoModel = new AsignaturasCursosModel();
    }

    public function index()
    {
        $cursos = $this->cursoModel
            ->join(
                'sw_especialidad',
                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
            )
            ->orderBy('cu_orden')
            ->findAll();

        $asignaturas = $this->asignaturaModel
            ->join(
                'sw_area',
                'sw_area.id_area = sw_asignatura.id_area'
            )->findAll();

        return view('Admin/AsignaturasCursos/index', [
            'cursos' => $cursos,
            'asignaturas' => $asignaturas
        ]);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'id_curso' => [
                    'label' => 'Curso',
                    'rules' => 'required|is_not_unique[sw_curso.id_curso]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ],
                'id_asignatura' => [
                    'label' => 'Asignatura',
                    'rules' => 'required|is_not_unique[sw_asignatura.id_asignatura]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                //Comprobar si ya existe la asociación de curso y asignatura
                $id_curso = $this->request->getVar('id_curso');
                $id_asignatura = $this->request->getVar('id_asignatura');
                $id_periodo_lectivo = session('id_periodo_lectivo');

                if ($this->asignaturaCursoModel->existeAsociacion($id_curso, $id_asignatura, $id_periodo_lectivo)) {
                    $msg = [
                        'error' => 'Ya existe la asociacion entre el curso y la asignatura seleccionados.'
                    ];
                } else {
                    $datos = [
                        'id_periodo_lectivo' => $id_periodo_lectivo,
                        'id_curso' => $id_curso,
                        'id_asignatura' => $id_asignatura,
                        'ac_orden' => $this->asignaturaCursoModel->getNextOrderNumber($id_curso)
                    ];

                    $this->asignaturaCursoModel->save($datos);

                    $msg = [
                        'success' => 'La Asociación Asignatura Curso fue guardada correctamente.'
                    ];
                }
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function dataAsignaturasCursos()
    {
        $id_curso = $this->request->getVar('id_curso');
        echo json_encode($this->asignaturaCursoModel->listarAsignaturasAsociadas($id_curso));
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            try {
                $id = $this->request->getVar('id');
                
                $this->asignaturaCursoModel->delete($id);

                $msg = [
                    'title'   => "Logrado!",
                    'icon'    => "success",
                    'message' => "La Asociación Asignatura Curso fue eliminada correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'title'   => "Oops!",
                    'icon'    => "error",
                    'message' => "No se pudo eliminar correctamente la Asociación Asignatura Curso..."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function saveNewPositions()
    {
        if ($this->request->isAJAX()) {
            foreach ($_POST['positions'] as $position) {
                $index = $position[0];
                $newPosition = $position[1];

                $this->asignaturaCursoModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
