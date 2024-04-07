<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UsuariosModel;
use App\Models\Admin\ParalelosModel;
use App\Models\Admin\ParalelosInspectoresModel;

class Paralelos_inspectores extends BaseController
{
    private $paraleloModel;
    private $usuarioModel;
    private $paraleloInspectorModel;

    public function __construct()
    {
        $this->paraleloModel = new ParalelosModel();
        $this->usuarioModel = new UsuariosModel();
        $this->paraleloInspectorModel = new ParalelosInspectoresModel();
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

        $usuarios = $this->usuarioModel
                ->select(
                    'sw_usuario.id_usuario,
                    sw_usuario.us_titulo,
                    sw_usuario.us_apellidos,
                    sw_usuario.us_nombres'
                )
                ->join(
                    'sw_usuario_perfil',
                    'sw_usuario.id_usuario = sw_usuario_perfil.id_usuario'
                )
                ->join(
                    'sw_perfil',
                    'sw_perfil.id_perfil = sw_usuario_perfil.id_perfil'
                )
                ->where('pe_nombre', 'Inspector')
                ->orderBy('us_apellidos')
                ->orderBy('us_nombres')
                ->findAll();

        return view('Admin/ParalelosInspectores/index', [
            'paralelos' => $paralelos,
            'usuarios' => $usuarios
        ]);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'id_paralelo' => [
                    'label' => 'Paralelo',
                    'rules' => 'required|is_not_unique[sw_paralelo.id_paralelo]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ],
                'id_usuario' => [
                    'label' => 'Docente',
                    'rules' => 'required|is_not_unique[sw_usuario.id_usuario]',
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
                //Comprobar si ya existe la asociación de paralelo y tutor
                $id_paralelo = $this->request->getVar('id_paralelo');
                $id_usuario = $this->request->getVar('id_usuario');
                $id_periodo_lectivo = session('id_periodo_lectivo');

                if ($this->paraleloInspectorModel->existeAsociacion($id_paralelo, $id_periodo_lectivo)) {
                    $msg = [
                        'error' => 'Ya existe un inspector asociado al paralelo seleccionado.'
                    ];
                } else {
                    $datos = [
                        'id_periodo_lectivo' => $id_periodo_lectivo,
                        'id_paralelo' => $id_paralelo,
                        'id_usuario' => $id_usuario
                    ];

                    $this->paraleloInspectorModel->save($datos);

                    $msg = [
                        'success' => 'La Asociación Paralelo Inspector fue guardada correctamente.'
                    ];
                }
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function dataParalelosInspectores()
    {
        $id_periodo_lectivo = session('id_periodo_lectivo');
        echo json_encode($this->paraleloInspectorModel->listarInspectoresAsociados($id_periodo_lectivo));
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            try {
                $id = $this->request->getVar('id');
                
                $this->paraleloInspectorModel->delete($id);

                $msg = [
                    'title'   => "Logrado!",
                    'icon'    => "success",
                    'message' => "La Asociación Paralelo Inspector fue eliminada correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'title'   => "Oops!",
                    'icon'    => "error",
                    'message' => "No se pudo eliminar correctamente la Asociación Paralelo Inspector..."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
