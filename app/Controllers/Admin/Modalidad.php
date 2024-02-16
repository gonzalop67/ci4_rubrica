<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InstitucionModel;
use App\Models\Admin\ModalidadesModel;

class Modalidad extends BaseController
{
    private $institucionModel;
    private $modalidadModel;

    public function __construct()
    {
        $this->institucionModel = new InstitucionModel();
        $this->modalidadModel = new ModalidadesModel();
    }

    public function index()
    {
        $Institucion = $this->institucionModel
            ->where('id_institucion', 1)
            ->first();
        $modalidades = $this->modalidadModel->listarModalidades();
        $data = [
            'nomInstitucion' => $Institucion->in_nombre,
            'urlInstitucion' => $Institucion->in_url,
            'modalidades'    => $modalidades
        ];

        return view('Admin/Modalidades/index', $data);
    }

    public function create()
    {
        $Institucion = $this->institucionModel
            ->where('id_institucion', 1)
            ->first();
        $data = [
            'nomInstitucion' => $Institucion->in_nombre,
            'urlInstitucion' => $Institucion->in_url,
        ];
        return view('Admin/Modalidades/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|is_unique[sw_modalidad.mo_nombre]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'is_unique' => 'El campo {field} debe ser único'
                ]
            ],
            'activo' => 'is_not_unique[sw_modalidad.mo_activo]'
        ])) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Tienes campos incorrectos'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'mo_nombre' => trim($this->request->getVar('nombre')),
            'mo_activo' => trim($this->request->getVar('activo')),
            'mo_orden'  => $this->modalidadModel->getNextOrderNumber()
        ];

        $this->modalidadModel->save($datos);

        return redirect('modalidades')->with('msg', [
            'type' => 'success',
            'body' => 'La modalidad fue guardada correctamente.'
        ]);
    }
}
