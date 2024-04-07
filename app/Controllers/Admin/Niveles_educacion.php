<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\NivelesEducacionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Niveles_educacion extends BaseController
{
    private $nivelEducacionModel;

    public function __construct()
    {
        $this->nivelEducacionModel = new NivelesEducacionModel();
    }

    public function index()
    {
        return view('Admin/NivelEducacion/index');
    }

    public function dataNivelesEducacion()
    {
        if ($this->request->isAJAX()) {
            $nivelesEducacion = $this->nivelEducacionModel->orderBy('orden')->findAll();

            $data = [
                'nivelesEducacion' => $nivelesEducacion
            ];

            $msg = [
                'data' => view('Admin/NivelEducacion/dataNivelesEducacion', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        return view('Admin/NivelEducacion/create');
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[48]|is_unique[sw_nivel_educacion.nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 48 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'es_bachillerato' => 'is_not_unique[sw_nivel_educacion.es_bachillerato]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'nombre' => trim($this->request->getVar('nombre')),
            'es_bachillerato' => trim($this->request->getVar('es_bachillerato')),
            'orden'  => $this->nivelEducacionModel->getNextOrderNumber()
        ];

        $this->nivelEducacionModel->save($datos);

        return redirect('niveles_educacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Nivel de Educación fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$nivel_educacion = $this->nivelEducacionModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/NivelEducacion/edit', [
            'nivel_educacion' => $nivel_educacion
        ]);
    }

    public function update()
    {
        $id_nivel_educacion = $this->request->getVar('id_nivel_educacion');
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => "required|max_length[48]|is_unique[sw_nivel_educacion.nombre,id_nivel_educacion,{$id_nivel_educacion}]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 48 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'es_bachillerato' => 'is_not_unique[sw_nivel_educacion.es_bachillerato]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'nombre' => trim($this->request->getVar('nombre')),
            'es_bachillerato' => trim($this->request->getVar('es_bachillerato')),
            'id_nivel_educacion' => $id_nivel_educacion
        ];

        $this->nivelEducacionModel->save($datos);

        return redirect('niveles_educacion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Nivel de Educación fue actualizado correctamente.'
        ]);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            try {
                $this->nivelEducacionModel->delete($id);

                $msg = [
                    'success' => true,
                    'icon'    => "success",
                    'message' => "El Nivel de Educación fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'success' => false,
                    'icon'    => "error",
                    'message' => "No se puede eliminar el Nivel de Educación porque tiene registros relacionados en otras tablas."
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

                $this->nivelEducacionModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}