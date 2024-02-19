<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InstitucionModel;
use App\Models\Admin\ModalidadesModel;
use App\Models\Admin\PeriodosLectivosModel;

class Periodos_lectivos extends BaseController
{
    private $modalidadModel;
    private $institucionModel;
    private $periodoLectivoModel;

    public function __construct()
    {
        $this->modalidadModel = new ModalidadesModel();
        $this->institucionModel = new InstitucionModel();
        $this->periodoLectivoModel = new PeriodosLectivosModel();
    }

    public function index()
    {
        $Institucion = $this->institucionModel
            ->where('id_institucion', 1)
            ->first();

        $periodos_lectivos = $this->periodoLectivoModel->listarPeriodosLectivos();

        $data = [
            'nomInstitucion' => $Institucion->in_nombre,
            'urlInstitucion' => $Institucion->in_url,
            'periodos_lectivos' => $periodos_lectivos
        ];

        return view('Admin/Periodos_lectivos/index', $data);
    }

    public function create()
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
        
        return view('Admin/Periodos_lectivos/create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'pe_anio_inicio' => [
                'label' => 'Año Inicial',
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'integer' => 'El campo {field} debe ser un número entero'
                ]
            ],
            
        ])) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Tienes campos incorrectos'
                ])
                ->with('errors', $this->validator->getErrors());
        }
    }
}