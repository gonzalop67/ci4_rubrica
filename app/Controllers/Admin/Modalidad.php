<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModalidadesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Modalidad extends BaseController
{
    private $modalidadModel;

    public function __construct()
    {
        $this->modalidadModel = new ModalidadesModel();
    }

    public function index()
    {
        return view('Admin/Modalidades/index');
    }

    public function dataModalidades()
    {
        if ($this->request->isAJAX()) {
            $modalidades = $this->modalidadModel->listarModalidades();

            $data = [
                'modalidades'    => $modalidades
            ];

            $msg = [
                'data' => view('Admin/Modalidades/dataModalidades', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        return view('Admin/Modalidades/create');
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[64]|is_unique[sw_modalidad.mo_nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'activo' => 'is_not_unique[sw_modalidad.mo_activo]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'mo_nombre' => trim(strtoupper($this->request->getVar('nombre'))),
            'mo_activo' => trim($this->request->getVar('activo')),
            'mo_orden'  => $this->modalidadModel->getNextOrderNumber()
        ];

        $this->modalidadModel->save($datos);

        return redirect('modalidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La modalidad fue guardada correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$modalidad = $this->modalidadModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Modalidades/edit', [
            'modalidad' => $modalidad
        ]);
    }

    public function update()
    {
        $modalidad = $this->modalidadModel->find($_POST['id_modalidad']);

        if (trim($_POST['nombre']) != $modalidad->mo_nombre) {
            $is_unique = '|is_unique[sw_modalidad.mo_nombre]';
        } else {
            $is_unique = '';
        }

        $reglas = [
            'nombre' => [
                'rules' => 'required|max_length[64]' . $is_unique,
                'errors' => [
                    'required'   => 'El campo Nombre es obligatorio.',
                    'max_length' => 'El campo Nombre no debe exceder los 64 caracteres.',
                    'is_unique'  => 'El campo Nombre debe ser único.'
                ]
            ],
            'activo' => [
                'rules' => 'required|is_not_unique[sw_modalidad.mo_activo]',
                'errors' => [
                    'required' => 'El campo Activo es obligatorio.',
                    'is_not_unique' => 'No existe la opción elegida en la base de datos.'
                ]
            ]
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Tienes campos incorrectos.'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $this->modalidadModel->save([
            'id_modalidad' => $_POST['id_modalidad'],
            'mo_nombre' => trim(strtoupper($_POST['nombre'])),
            'mo_activo' => $_POST['activo']
        ]);

        return redirect('modalidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La modalidad fue actualizada correctamente.'
        ]);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            try {
                $this->modalidadModel->delete($id);

                $msg = [
                    'success' => true,
                    'icon'    => "success",
                    'message' => "La Modalidad fue eliminada correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'icon'    => "error",
                    'message' => "La Modalidad no se puede eliminar porque tiene periodos lectivos asociados."
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

                $this->modalidadModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
