<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UsuariosModel;
use App\Models\Admin\PerfilesModel;

class Usuarios extends BaseController
{
    private $usuariosModel;
    private $perfilesModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
        $this->perfilesModel = new PerfilesModel();
    }

    public function index()
    {
        return view('Admin/Usuarios/index');
    }

    public function dataUsuarios()
    {
        if ($this->request->isAJAX()) {
            $usuarios = $this->usuariosModel->orderBy('us_apellidos')->orderBy('us_nombres')->findAll();

            $data = [
                'usuarios' => $usuarios
            ];

            $msg = [
                'data' => view('Admin/Usuarios/dataUsuarios', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        $perfiles = $this->perfilesModel->orderBy('pe_nombre')->findAll();
        return view('Admin/Usuarios/create', [
            'perfiles' => $perfiles
        ]);
    }
}