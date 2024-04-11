<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InsumosEvaluacionModel;
use App\Models\Admin\PeriodosEvaluacionModel;
use App\Models\Admin\TiposAsignaturaModel;

use Hashids\Hashids;

class Insumos_evaluacion extends BaseController
{
    private $insumoEvaluacionModel;
    private $periodoEvaluacionModel;
    private $tipoAsignaturaModel;

    public function __construct()
    {
        $this->insumoEvaluacionModel = new InsumosEvaluacionModel();
        $this->periodoEvaluacionModel = new PeriodosEvaluacionModel();
        $this->tipoAsignaturaModel = new TiposAsignaturaModel();
    }

    public function index()
    {
        $periodos_evaluacion = $this->periodoEvaluacionModel
            ->where('id_periodo_lectivo', session('id_periodo_lectivo'))
            ->orderBy('pe_orden')->findAll();
        $tipos_asignatura = $this->tipoAsignaturaModel->orderBy('id_tipo_asignatura')->findAll();

        return view('Admin/InsumosEvaluacion/index', [
            'periodos_evaluacion' => $periodos_evaluacion,
            'tipos_asignatura' => $tipos_asignatura
        ]);
    }

    public function dataInsumosEvaluacion()
    {
        if ($this->request->isAJAX()) {
            $id_aporte_evaluacion = $this->request->getVar('id_aporte_evaluacion');
            $id_tipo_asignatura = $this->request->getVar('id_tipo_asignatura');

            $insumos_evaluacion = $this->insumoEvaluacionModel
                ->where('id_aporte_evaluacion', $id_aporte_evaluacion)
                ->where('id_tipo_asignatura', $id_tipo_asignatura)
                ->orderBy('id_rubrica_evaluacion')
                ->findAll();

            $data = [
                'insumos_evaluacion' => $insumos_evaluacion
            ];

            $msg = [
                'data' => view('Admin/InsumosEvaluacion/dataInsumosEvaluacion', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Admin/InsumosEvaluacion/modalInsert')
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nombre' => [
                    'label' => 'Nombre',
                    'rules' => "required|max_length[36]",
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 36 caracteres.'
                    ]
                ],
                'abreviatura' => [
                    'label' => 'Abreviatura',
                    'rules' => 'required|max_length[6]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 6 caracteres.'
                    ]
                ],
                'descripcion' => [
                    'label' => 'Descripción',
                    'rules' => 'required|max_length[256]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 256 caracteres.'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                $datos = [
                    'id_aporte_evaluacion' => $this->request->getVar('aporte_evaluacion_id'),
                    'id_tipo_asignatura' => $this->request->getVar('tipo_asignatura_id'),
                    'ru_nombre' => strtoupper(trim($this->request->getVar('nombre'))),
                    'ru_abreviatura' => strtoupper(trim($this->request->getVar('abreviatura'))),
                    'ru_descripcion' => strtoupper(trim($this->request->getVar('descripcion')))
                ];

                $this->insumoEvaluacionModel->save($datos);

                $msg = [
                    'success' => 'El Insumo de Evaluación fue insertado exitosamente.'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id_rubrica_evaluacion = $this->request->getVar('id_rubrica_evaluacion');

            $row = $this->insumoEvaluacionModel->find($id_rubrica_evaluacion);

            $data = [
                'id_rubrica_evaluacion' => $row->id_rubrica_evaluacion,
                'ru_nombre' => $row->ru_nombre,
                'ru_abreviatura' => $row->ru_abreviatura,
                'ru_descripcion' => $row->ru_descripcion
            ];

            $msg = [
                'success' => view('Admin/InsumosEvaluacion/modalEdit', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'nombre' => [
                    'label' => 'Nombre',
                    'rules' => "required|max_length[24]",
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 24 caracteres.'
                    ]
                ],
                'abreviatura' => [
                    'label' => 'Abreviatura',
                    'rules' => 'required|max_length[6]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 6 caracteres.'
                    ]
                ],
                'descripcion' => [
                    'label' => 'Descripción',
                    'rules' => 'required|max_length[256]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 256 caracteres.'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                $datos = [
                    'id_rubrica_evaluacion' => $this->request->getVar('id_rubrica_evaluacion'),
                    'ru_nombre' => strtoupper(trim($this->request->getVar('nombre'))),
                    'ru_abreviatura' => strtoupper(trim($this->request->getVar('abreviatura'))),
                    'ru_descripcion' => strtoupper(trim($this->request->getVar('descripcion')))
                ];

                $this->insumoEvaluacionModel->save($datos);

                $msg = [
                    'success' => 'El Insumo de Evaluación fue actualizado exitosamente.'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function delete($id)
    {
        $hash = new Hashids();

        if ($this->request->isAJAX()) {
            // $id = $this->request->getVar('id');
            $id = $hash->decode($id);

            try {
                $this->insumoEvaluacionModel->delete($id);

                $msg = [
                    'icon'    => "success",
                    'message' => "El Insumo de Evaluación fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'icon'    => "error",
                    'message' => "No se pudo eliminar correctamente el Insumo de Evaluación..."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
