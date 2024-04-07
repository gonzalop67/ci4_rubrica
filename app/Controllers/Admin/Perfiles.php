<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PerfilesModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Hashids\Hashids;

class Perfiles extends BaseController
{
    private $perfilModel;

    public function __construct()
    {
        $this->perfilModel = new PerfilesModel();
    }

    public function index()
    {
        return view('Admin/Perfiles/index');
    }

    public function dataPerfiles()
    {
        if ($this->request->isAJAX()) {
            $perfiles = $this->perfilModel->orderBy('pe_nombre')->findAll();

            $data = [
                'perfiles' => $perfiles
            ];

            $msg = [
                'data' => view('Admin/Perfiles/dataPerfiles', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        return view('Admin/Perfiles/create');
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[16]|is_unique[sw_perfil.pe_nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo Nombre no debe exceder los 16 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'pe_nombre' => trim($this->request->getVar('nombre'))
        ];

        $this->perfilModel->save($datos);

        return redirect('perfiles')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El perfil fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$perfil = $this->perfilModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Perfiles/edit', [
            'perfil' => $perfil
        ]);
    }

    public function update()
    {
        $id_perfil = $this->request->getVar('id_perfil');

        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => "required|max_length[16]|is_unique[sw_perfil.pe_nombre,id_perfil,{$id_perfil}]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo Nombre no debe exceder los 16 caracteres.',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'id_perfil' => $this->request->getVar('id_perfil'),
            'pe_nombre' => trim($this->request->getVar('nombre'))
        ];

        $this->perfilModel->save($datos);

        return redirect('perfiles')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El perfil fue actualizado correctamente.'
        ]);
    }

    public function delete($id)
    {
        $hash = new Hashids();

        if ($this->request->isAJAX()) {
            // $id = $this->request->getVar('id');
            $id = $hash->decode($id);

            try {
                $this->perfilModel->delete($id);

                $msg = [
                    'icon'    => "success",
                    'message' => "El Perfil fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'icon'    => "error",
                    'message' => "No se puede eliminar el Perfil porque tiene registros relacionados en otras tablas."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
