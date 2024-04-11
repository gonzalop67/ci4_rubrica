<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AportesEvaluacionModel;
use App\Models\Admin\PeriodosEvaluacionModel;
use App\Models\Admin\TiposAporteModel;

use Hashids\Hashids;

class Aportes_evaluacion extends BaseController
{
    private $aporteEvaluacionModel;
    private $periodoEvaluacionModel;
    private $tiposAporteModel;

    public function __construct()
    {
        $this->aporteEvaluacionModel = new AportesEvaluacionModel();
        $this->periodoEvaluacionModel = new PeriodosEvaluacionModel();
        $this->tiposAporteModel = new TiposAporteModel();
    }

    public function index()
    {
        $periodos_evaluacion = $this->periodoEvaluacionModel
            ->where('id_periodo_lectivo', session('id_periodo_lectivo'))
            ->orderBy('pe_orden')
            ->findAll();

        return view('Admin/AportesEvaluacion/index', [
            'periodos_evaluacion' => $periodos_evaluacion
        ]);
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {
            $tipos_aporte = $this->tiposAporteModel->orderBy('id_tipo_aporte')->findAll();
            $msg = [
                'data' => view('Admin/AportesEvaluacion/modalInsert', [
                    'tipos_aporte' => $tipos_aporte
                ])
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
                    'rules' => "required|max_length[48]",
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 48 caracteres.'
                    ]
                ],
                'abreviatura' => [
                    'label' => 'Abreviatura',
                    'rules' => 'required|max_length[8]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 8 caracteres.'
                    ]
                ],
                'descripcion' => [
                    'label' => 'Descripción',
                    'rules' => 'required|max_length[256]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 256 caracteres.'
                    ]
                ],
                'ponderacion' => [
                    'label' => 'Ponderación',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'numeric' => 'El campo {field} debe contener un valor numérico.'
                    ]
                ],
                'fecha_inicio' => [
                    'label' => 'Fecha de inicio',
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                    ]
                ],
                'fecha_fin' => [
                    'label' => 'Fecha de fin',
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                    ]
                ],
                'id_tipo_aporte' => [
                    'label' => 'Tipo de Aporte',
                    'rules' => 'required|is_not_unique[sw_tipo_aporte.id_tipo_aporte]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese índice para tipo de aporte'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                $datos = [
                    'id_periodo_evaluacion' => $this->request->getVar('periodo_evaluacion_id'),
                    'id_tipo_aporte' => $this->request->getVar('id_tipo_aporte'),
                    'ap_nombre' => strtoupper(trim($this->request->getVar('nombre'))),
                    'ap_abreviatura' => strtoupper(trim($this->request->getVar('abreviatura'))),
                    'ap_ponderacion' => trim($this->request->getVar('ponderacion')),
                    'ap_descripcion' => strtoupper(trim($this->request->getVar('descripcion'))),
                    'ap_fecha_apertura' => $this->request->getVar('fecha_inicio'),
                    'ap_fecha_cierre' => $this->request->getVar('fecha_fin'),
                    'ap_orden' => $this->aporteEvaluacionModel->getNextOrderNumber($this->request->getVar('periodo_evaluacion_id'))
                ];

                $this->aporteEvaluacionModel->save($datos);

                $msg = [
                    'success' => 'El Aporte de Evaluación fue insertado exitosamente.'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function dataAportesEvaluacion()
    {
        if ($this->request->isAJAX()) {
            $id_periodo_evaluacion = $this->request->getVar('id_periodo_evaluacion');
            $aportes_evaluacion = $this->aporteEvaluacionModel
                ->join('sw_tipo_aporte', 'sw_tipo_aporte.id_tipo_aporte = sw_aporte_evaluacion.id_tipo_aporte')
                ->where('id_periodo_evaluacion', $id_periodo_evaluacion)
                ->orderBy('ap_orden')
                ->findAll();

            $data = [
                'aportes_evaluacion' => $aportes_evaluacion
            ];

            $msg = [
                'data' => view('Admin/AportesEvaluacion/dataAportesEvaluacion', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id_aporte_evaluacion = $this->request->getVar('id_aporte_evaluacion');

            $row = $this->aporteEvaluacionModel->find($id_aporte_evaluacion);
            $tipos_aporte = $this->tiposAporteModel->orderBy('id_tipo_aporte')->findAll();

            $data = [
                'tipos_aporte' => $tipos_aporte,
                'id_aporte_evaluacion' => $row->id_aporte_evaluacion,
                'id_periodo_evaluacion' => $row->id_periodo_evaluacion,
                'id_tipo_aporte' => $row->id_tipo_aporte,
                'ap_nombre' => $row->ap_nombre,
                'ap_descripcion' => $row->ap_descripcion,
                'ap_abreviatura' => $row->ap_abreviatura,
                'ap_fecha_apertura' => $row->ap_fecha_apertura,
                'ap_fecha_cierre' => $row->ap_fecha_cierre,
                'ap_ponderacion' => $row->ap_ponderacion
            ];

            $msg = [
                'success' => view('Admin/AportesEvaluacion/modalEdit', $data)
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
                    'rules' => "required|max_length[48]",
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 48 caracteres.'
                    ]
                ],
                'abreviatura' => [
                    'label' => 'Abreviatura',
                    'rules' => 'required|max_length[8]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 8 caracteres.'
                    ]
                ],
                'descripcion' => [
                    'label' => 'Descripción',
                    'rules' => 'required|max_length[256]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 256 caracteres.'
                    ]
                ],
                'ponderacion' => [
                    'label' => 'Ponderación',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'numeric' => 'El campo {field} debe contener un valor numérico.'
                    ]
                ],
                'fecha_inicio' => [
                    'label' => 'Fecha de inicio',
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                    ]
                ],
                'fecha_fin' => [
                    'label' => 'Fecha de fin',
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                    ]
                ],
                'id_tipo_aporte' => [
                    'label' => 'Tipo de Aporte',
                    'rules' => 'required|is_not_unique[sw_tipo_aporte.id_tipo_aporte]',
                    'erros' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese índice para tipo de aporte'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                $datos = [
                    'id_aporte_evaluacion' => $this->request->getVar('id_aporte_evaluacion'),
                    'id_tipo_aporte' => $this->request->getVar('id_tipo_aporte'),
                    'ap_nombre' => strtoupper(trim($this->request->getVar('nombre'))),
                    'ap_abreviatura' => strtoupper(trim($this->request->getVar('abreviatura'))),
                    'ap_ponderacion' => trim($this->request->getVar('ponderacion')),
                    'ap_descripcion' => trim($this->request->getVar('descripcion')),
                    'ap_fecha_apertura' => $this->request->getVar('fecha_inicio'),
                    'ap_fecha_cierre' => $this->request->getVar('fecha_fin')
                ];

                $this->aporteEvaluacionModel->save($datos);

                $msg = [
                    'success' => 'El Aporte de Evaluación fue actualizado exitosamente.'
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

                $this->aporteEvaluacionModel->actualizarOrden($index, $newPosition);
            }
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
                $this->aporteEvaluacionModel->delete($id);

                $msg = [
                    'icon'    => "success",
                    'message' => "El Aporte de Evaluación fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'icon'    => "error",
                    'message' => "No se pudo eliminar correctamente el Aporte de Evaluación..."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function getAportesEvaluacion()
    {
        if ($this->request->isAJAX()) {
            $id_periodo_evaluacion = $this->request->getVar('id_periodo_evaluacion');

            echo $this->aporteEvaluacionModel->getAportesEvaluacion($id_periodo_evaluacion);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
