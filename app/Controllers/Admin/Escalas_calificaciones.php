<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\EscalasCalificacionesModel;

use Hashids\Hashids;

class Escalas_calificaciones extends BaseController
{
    private $escalaCalificacionesModel;

    public function __construct()
    {
        $this->escalaCalificacionesModel = new EscalasCalificacionesModel();
    }

    public function index()
    {
        return view('Admin/EscalaCalificaciones/index');
    }

    public function dataEscalasCalificacion()
    {
        if ($this->request->isAJAX()) {
            $id_periodo_lectivo = session('id_periodo_lectivo');

            $escalas_calificaciones = $this->escalaCalificacionesModel
                ->where('id_periodo_lectivo', $id_periodo_lectivo)
                ->orderBy('ec_orden')
                ->findAll();

            $data = [
                'escalas_calificaciones' => $escalas_calificaciones
            ];

            $msg = [
                'data' => view('Admin/EscalaCalificaciones/dataEscalasCalificaciones', $data)
            ];

            return json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Admin/EscalaCalificaciones/modalInsert')
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
                'cualitativa' => [
                    'label' => 'Escala Cualitativa',
                    'rules' => "required|max_length[64]",
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                    ]
                ],
                'cuantitativa' => [
                    'label' => 'Escala Cuantitativa',
                    'rules' => 'required|max_length[16]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 16 caracteres.'
                    ]
                ],
                'nota_minima' => [
                    'label' => 'Nota Mínima',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'numeric' => 'El campo {field} debe contener un valor numérico.'
                    ]
                ],
                'nota_maxima' => [
                    'label' => 'Nota Máxima',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'numeric' => 'El campo {field} debe contener un valor numérico.'
                    ]
                ],
                'equivalencia' => [
                    'label' => 'Equivalencia',
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 2 caracteres.'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                $datos = [
                    'id_periodo_lectivo' => session('id_periodo_lectivo'),
                    'ec_cualitativa' => trim($this->request->getVar('cualitativa')),
                    'ec_cuantitativa' => trim($this->request->getVar('cuantitativa')),
                    'ec_nota_minima' => $this->request->getVar('nota_minima'),
                    'ec_nota_maxima' => $this->request->getVar('nota_maxima'),
                    'ec_equivalencia' => trim($this->request->getVar('equivalencia')),
                    'ec_orden' => $this->escalaCalificacionesModel->getNextOrderNumber(session('id_periodo_lectivo'))
                ];

                $this->escalaCalificacionesModel->save($datos);

                $msg = [
                    'success' => 'La Escala de Calificaciones fue insertada exitosamente.'
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
            $id_escala_calificaciones = $this->request->getVar('id_escala_calificaciones');

            $row = $this->escalaCalificacionesModel->find($id_escala_calificaciones);

            $data = [
                'id_escala_calificaciones' => $row->id_escala_calificaciones,
                'ec_cualitativa' => $row->ec_cualitativa,
                'ec_cuantitativa' => $row->ec_cuantitativa,
                'ec_nota_minima' => $row->ec_nota_minima,
                'ec_nota_maxima' => $row->ec_nota_maxima,
                'ec_equivalencia' => $row->ec_equivalencia
            ];

            $msg = [
                'success' => view('Admin/EscalaCalificaciones/modalEdit', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'cualitativa' => [
                    'label' => 'Escala Cualitativa',
                    'rules' => "required|max_length[64]",
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                    ]
                ],
                'cuantitativa' => [
                    'label' => 'Escala Cuantitativa',
                    'rules' => 'required|max_length[16]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 16 caracteres.'
                    ]
                ],
                'nota_minima' => [
                    'label' => 'Nota Mínima',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'numeric' => 'El campo {field} debe contener un valor numérico.'
                    ]
                ],
                'nota_maxima' => [
                    'label' => 'Nota Máxima',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'numeric' => 'El campo {field} debe contener un valor numérico.'
                    ]
                ],
                'equivalencia' => [
                    'label' => 'Equivalencia',
                    'rules' => 'required|max_length[2]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'max_length' => 'El campo {field} no debe exceder los 2 caracteres.'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {
                $datos = [
                    'id_escala_calificaciones' => $this->request->getVar('id_escala_calificaciones'),
                    'ec_cualitativa' => trim($this->request->getVar('cualitativa')),
                    'ec_cuantitativa' => trim($this->request->getVar('cuantitativa')),
                    'ec_nota_minima' => $this->request->getVar('nota_minima'),
                    'ec_nota_maxima' => $this->request->getVar('nota_maxima'),
                    'ec_equivalencia' => trim($this->request->getVar('equivalencia'))
                ];

                $this->escalaCalificacionesModel->save($datos);

                $msg = [
                    'success' => 'La Escala de Calificaciones fue actualizada exitosamente.'
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

                $this->escalaCalificacionesModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function delete($id)
    {
        $hash = new Hashids();

        if ($this->request->isAJAX()) {
            $id = $hash->decode($id);

            try {
                $this->escalaCalificacionesModel->delete($id);

                $msg = [
                    'icon'    => "success",
                    'message' => "La Escala de Calificaciones fue eliminada correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'icon'    => "error",
                    'message' => "No se pudo eliminar correctamente la Escala de Calificaciones..."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
