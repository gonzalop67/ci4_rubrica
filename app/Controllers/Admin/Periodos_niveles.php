<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModalidadesModel;
use App\Models\Admin\NivelesEducacionModel;
use App\Models\Admin\PeriodosNivelesModel;

class Periodos_niveles extends BaseController
{
    private $modalidadModel;
    private $nivelEducacionModel;
    private $periodoNivelModel;

    public function __construct()
    {
        $this->modalidadModel = new ModalidadesModel();
        $this->nivelEducacionModel = new NivelesEducacionModel();
        $this->periodoNivelModel = new PeriodosNivelesModel();
    }

    public function index()
    {
        $modalidades = $this->modalidadModel->listarModalidades();
        $niveles_educacion = $this->nivelEducacionModel->orderBy('orden')->findAll();

        return view('Admin/PeriodosNiveles/index',[
            'modalidades'       => $modalidades,
            'niveles_educacion' => $niveles_educacion
        ]);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'id_periodo_lectivo' => [
                    'label' => 'Periodo Lectivo',
                    'rules' => 'required|is_not_unique[sw_periodo_lectivo.id_periodo_lectivo]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ],
                'id_nivel_educacion' => [
                    'label' => 'Nivel de educación',
                    'rules' => 'required|is_not_unique[sw_nivel_educacion.id_nivel_educacion]',
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
                //Comprobar si ya existe la asociación de periodo lectivo y nivel de educación
                $id_periodo_lectivo = $this->request->getVar('id_periodo_lectivo');
                $id_nivel_educacion = $this->request->getVar('id_nivel_educacion');

                if ($this->periodoNivelModel->existeAsociacion($id_periodo_lectivo, $id_nivel_educacion)) {
                    $msg = [
                        'error' => 'Ya existe la asociacion entre el periodo lectivo y el nivel de educación seleccionados.'
                    ];
                } else {
                    $datos = [
                        'id_periodo_lectivo' => $id_periodo_lectivo,
                        'id_nivel_educacion' => $id_nivel_educacion
                    ];

                    $this->periodoNivelModel->save($datos);

                    $msg = [
                        'success' => 'La Asociación Periodo Lectivo - Nivel de educación fue guardada correctamente.'
                    ];
                }
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function dataPeriodosNiveles()
    {
        $id_periodo_lectivo = $this->request->getVar('id_periodo_lectivo');
        echo json_encode($this->periodoNivelModel->listarNivelesAsociados($id_periodo_lectivo));
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {

            try {
                $id = $this->request->getVar('id');
                
                $this->periodoNivelModel->delete($id);

                $msg = [
                    'title'   => "Logrado!",
                    'icon'    => "success",
                    'message' => "La Asociación Periodo Lectivo - Nivel de educación fue eliminada correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'title'   => "Oops!",
                    'icon'    => "error",
                    'message' => "No se pudo eliminar correctamente La Asociación Periodo Lectivo - Nivel de educación..."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}