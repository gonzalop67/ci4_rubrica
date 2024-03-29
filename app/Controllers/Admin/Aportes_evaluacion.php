<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AportesEvaluacionModel;
use App\Models\Admin\PeriodosEvaluacionModel;
use App\Models\Admin\TiposAporteModel;
use CodeIgniter\Exceptions\PageNotFoundException;

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
        $periodos_evaluacion = $this->periodoEvaluacionModel->orderBy('pe_orden')->findAll();

        return view('Admin/AportesEvaluacion/index', [
            'periodos_evaluacion' => $periodos_evaluacion
        ]);
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {
            $tipos_aporte = $this->tiposAporteModel->orderBy('id_tipo_aporte')->findAll();
            $msg = [
                'data' => view('Admin/AportesEvaluacion/modalInsert',[
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
            'ponderacion' => [
                'label' => 'Ponderación',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'numeric' => 'El campo {field} debe contener un valor numérico.'
                ]
            ],
            'id_tipo_periodo' => 'is_not_unique[sw_tipo_periodo.id_tipo_periodo]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Validar si se repite el nombre o la abreviatura del periodo de evaluación para el mismo periodo lectivo
        $nombre = trim($this->request->getVar('nombre'));
        $abreviatura = trim($this->request->getVar('abreviatura'));

        $id_periodo_lectivo = session('id_periodo_lectivo');

        if ($this->periodoEvaluacionModel->existeCampoPeriodoEvaluacion('pe_nombre', $nombre, $id_periodo_lectivo) || $this->periodoEvaluacionModel->existeCampoPeriodoEvaluacion('pe_abreviatura', $abreviatura, $id_periodo_lectivo)) {
            return redirect()->back()->withInput()
                ->with('errors', [
                    'nombre' => 'El nombre del periodo de evaluación ya se encuentra utilizado para el periodo lectivo actual.',
                    'abreviatura' => 'La abreviatura del periodo de evaluación ya se encuentra utilizada para el periodo lectivo actual.'
                ]);
        }

        $datos = [
            'id_periodo_lectivo' => $id_periodo_lectivo,
            'id_tipo_periodo' => $this->request->getVar('id_tipo_periodo'),
            'pe_nombre' => strtoupper($nombre),
            'pe_abreviatura' => strtoupper($abreviatura),
            'pe_ponderacion' => trim($this->request->getVar('ponderacion'))
        ];

        $this->periodoEvaluacionModel->save($datos);

        return redirect('periodos_evaluacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Periodo de Evaluación fue insertado correctamente.'
        ]);
    }

    public function dataAportesEvaluacion()
    {
        if ($this->request->isAJAX()) {
            $id_periodo_evaluacion = $this->request->getVar('id_periodo_evaluacion');
            $aportes_evaluacion = $this->aporteEvaluacionModel
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

    public function edit(string $id)
    {
        if (!$periodo_evaluacion = $this->periodoEvaluacionModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $tipos_periodos = $this->tiposPeriodoModel->findAll();
        $datos = [
            'periodo_evaluacion' => $periodo_evaluacion,
            'tipos_periodos' => $tipos_periodos
        ];
        return view('Admin/PeriodosEvaluacion/edit', $datos);
    }

    public function update()
    {
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
            'ponderacion' => [
                'label' => 'Ponderación',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'numeric' => 'El campo {field} debe contener un valor numérico.'
                ]
            ],
            'id_tipo_periodo' => 'is_not_unique[sw_tipo_periodo.id_tipo_periodo]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Validar si se repite el nombre o la abreviatura del periodo de evaluación para el mismo periodo lectivo
        $nombre = trim($this->request->getVar('nombre'));
        $abreviatura = trim($this->request->getVar('abreviatura'));

        $id_periodo_lectivo = session('id_periodo_lectivo');
        $id_periodo_evaluacion = $this->request->getVar('id_periodo_evaluacion');

        if ($this->periodoEvaluacionModel->existeRepetidoPeriodoEvaluacion('pe_nombre', $nombre, $id_periodo_lectivo, $id_periodo_evaluacion) || $this->periodoEvaluacionModel->existeRepetidoPeriodoEvaluacion('pe_abreviatura', $abreviatura, $id_periodo_lectivo, $id_periodo_evaluacion)) {
            return redirect()->back()->withInput()
                ->with('errors', [
                    'nombre' => 'El nombre del periodo de evaluación ya se encuentra utilizado para el periodo lectivo actual.',
                    'abreviatura' => 'La abreviatura del periodo de evaluación ya se encuentra utilizada para el periodo lectivo actual.'
                ]);
        }

        $datos = [
            'id_periodo_evaluacion' => $id_periodo_evaluacion,
            'id_periodo_lectivo' => $id_periodo_lectivo,
            'id_tipo_periodo' => $this->request->getVar('id_tipo_periodo'),
            'pe_nombre' => strtoupper($nombre),
            'pe_abreviatura' => strtoupper($abreviatura),
            'pe_ponderacion' => trim($this->request->getVar('ponderacion'))
        ];

        $this->periodoEvaluacionModel->save($datos);

        return redirect('periodos_evaluacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Periodo de Evaluación fue actualizado correctamente.'
        ]);
    }

    public function saveNewPositions()
    {
        if ($this->request->isAJAX()) {
            foreach ($_POST['positions'] as $position) {
                $index = $position[0];
                $newPosition = $position[1];

                $this->periodoEvaluacionModel->actualizarOrden($index, $newPosition);
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
                $this->periodoEvaluacionModel->delete($id);

                $msg = [
                    'icon'    => "success",
                    'message' => "El Periodo de Evaluación fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'icon'    => "error",
                    'message' => "No se puede eliminar el Periodo de Evaluación porque tiene registros relacionados en otras tablas."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
