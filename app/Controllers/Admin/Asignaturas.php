<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\AreasModel;
use App\Models\Admin\AsignaturasModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use Hashids\Hashids;

class Asignaturas extends BaseController
{
    private $asignaturaModel;
    private $areaModel;

    public function __construct()
    {
        $this->asignaturaModel = new AsignaturasModel();
        $this->areaModel = new AreasModel();
    }

    public function index()
    {
        return view('Admin/Asignaturas/index');
    }

    public function dataAsignaturas()
    {
        if ($this->request->isAJAX()) {
            $asignaturas = $this->asignaturaModel
                                ->join('sw_area', 'sw_area.id_area = sw_asignatura.id_area')
                                ->orderBy('as_nombre')->findAll();

            $data = [
                'asignaturas' => $asignaturas
            ];

            $msg = [
                'data' => view('Admin/Asignaturas/dataAsignaturas', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        $areas = $this->areaModel->orderBy('ar_nombre')->findAll();
        $datos = [
            'areas' => $areas
        ];
        return view('Admin/Asignaturas/create', $datos);
    }

    public function store()
    {
        /* if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[45]|is_unique[sw_area.ar_nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo Nombre no debe exceder los 45 caracteres.',
                    'is_unique' => 'Ya existe el {field} en la base de datos.'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'ar_nombre' => trim(strtoupper($this->request->getVar('nombre')))
        ];

        $this->areaModel->save($datos);

        return redirect('areas')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El área fue guardada correctamente.'
        ]); */
    }

    public function edit(string $id)
    {
       /*  if (!$area = $this->areaModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Areas/edit', [
            'area' => $area
        ]); */
    }

    public function update()
    {
        /* $id_area = $this->request->getVar('id_area');

        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => "required|max_length[45]|is_unique[sw_area.ar_nombre,id_area,{$id_area}]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo Nombre no debe exceder los 45 caracteres.',
                    'is_unique' => 'Ya existe el {field} en la base de datos.'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'id_area' => $this->request->getVar('id_area'),
            'ar_nombre' => trim($this->request->getVar('nombre'))
        ];

        $this->areaModel->save($datos);

        return redirect('areas')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Area fue actualizada correctamente.'
        ]); */
    }

    public function delete($id)
    {
        /* $hash = new Hashids();

        if ($this->request->isAJAX()) {
            // $id = $this->request->getVar('id');
            $id = $hash->decode($id);

            try {
                $this->areaModel->delete($id);

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
        } */
    }
}
