<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InstitucionModel;
use App\Models\Admin\PeriodosLectivosModel;

class Periodos_lectivos extends BaseController
{
    private $institucionModel;
    private $periodoLectivoModel;

    public function __construct()
    {
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
}