<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\EspecialidadesModel;
use App\Models\Admin\NivelesEducacionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Especialidades extends BaseController
{
    private $especialidadModel;
    private $nivelEducacionModel;

    public function __construct()
    {
        $this->especialidadModel = new EspecialidadesModel();
        $this->nivelEducacionModel = new NivelesEducacionModel();
    }

    public function index()
    {
        return view('Admin/Especialidades/index');
    }

    public function dataEspecialidades()
    {
        if ($this->request->isAJAX()) {
            $especialidades = $this->especialidadModel->orderBy('es_orden')->findAll();

            $data = [
                'especialidades' => $especialidades
            ];

            $msg = [
                'data' => view('Admin/Especialidades/dataEspecialidades', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        $niveles_educacion = $this->nivelEducacionModel->orderBy('orden')->findAll();
        return view('Admin/Especialidades/create', [
            'niveles_educacion' => $niveles_educacion
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[48]|is_unique[sw_especialidad.es_nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 48 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'figura' => [
                'label' => 'Figura',
                'rules' => 'required|max_length[50]|is_unique[sw_especialidad.es_figura]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 50 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'abreviatura' => [
                'label' => 'Abreviatura',
                'rules' => 'required|max_length[15]|is_unique[sw_especialidad.es_abreviatura]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 15 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'id_nivel_educacion' => 'is_not_unique[sw_nivel_educacion.id_nivel_educacion]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'id_nivel_educacion' => $this->request->getVar('id_nivel_educacion'),
            'es_nombre' => trim($this->request->getVar('nombre')),
            'es_figura' => trim($this->request->getVar('figura')),
            'es_abreviatura' => trim($this->request->getVar('abreviatura')),
            'es_orden'  => $this->especialidadModel->getNextOrderNumber()
        ];

        $this->especialidadModel->save($datos);

        return redirect('especialidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La especialidad fue guardada correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$especialidad = $this->especialidadModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $niveles_educacion = $this->nivelEducacionModel->orderBy('orden')->findAll();
        return view('Admin/Especialidades/edit', [
            'especialidad' => $especialidad,
            'niveles_educacion' => $niveles_educacion
        ]);
    }

    public function update()
    {
        $id_especialidad = $this->request->getVar('id_especialidad');

        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => "required|max_length[48]|is_unique[sw_especialidad.es_nombre,id_especialidad,{$id_especialidad}]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 48 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'figura' => [
                'label' => 'Figura',
                'rules' => "required|max_length[50]|is_unique[sw_especialidad.es_figura,id_especialidad,{$id_especialidad}]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 50 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'abreviatura' => [
                'label' => 'Abreviatura',
                'rules' => "required|max_length[15]|is_unique[sw_especialidad.es_abreviatura,id_especialidad,{$id_especialidad}]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 15 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'id_nivel_educacion' => 'is_not_unique[sw_nivel_educacion.id_nivel_educacion]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'id_especialidad' => $id_especialidad,
            'id_nivel_educacion' => $this->request->getVar('id_nivel_educacion'),
            'es_nombre' => trim($this->request->getVar('nombre')),
            'es_figura' => trim($this->request->getVar('figura')),
            'es_abreviatura' => trim($this->request->getVar('abreviatura'))
        ];

        $this->especialidadModel->save($datos);

        return redirect('especialidades')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'La especialidad fue actualizada correctamente.'
        ]);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            try {
                $this->especialidadModel->delete($id);

                $msg = [
                    'success' => true,
                    'icon'    => "success",
                    'message' => "La especialidad fue eliminada correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'success' => false,
                    'icon'    => "error",
                    'message' => "No se puede eliminar la Especialidad porque tiene registros relacionados en otras tablas."
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

                $this->especialidadModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
