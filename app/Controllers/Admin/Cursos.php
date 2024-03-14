<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CursosModel;

class Cursos extends BaseController
{
    private $cursoModel;

    public function __construct()
    {
        $this->cursoModel = new CursosModel();
    }

    public function index()
    {
        return view('Admin/Cursos/index');
    }

    public function dataCursos()
    {
        if ($this->request->isAJAX()) {
            $cursos = $this->cursoModel->orderBy('cu_orden')->findAll();

            $data = [
                'cursos' => $cursos
            ];

            $msg = [
                'data' => view('Admin/Cursos/dataCursos', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        return view('Admin/Cursos/create');
    }
}