<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\EspecialidadesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Especialidades extends BaseController
{
    private $especialidadModel;

    public function __construct()
    {
        $this->especialidadModel = new EspecialidadesModel();
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
}