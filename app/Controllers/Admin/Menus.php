<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MenusModel;
use App\Models\Admin\PerfilesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Menus extends BaseController
{
    private $menuModel;
    private $perfilModel;

    public function __construct()
    {
        $this->menuModel = new MenusModel();
        $this->perfilModel = new PerfilesModel();
    }

    public function index()
    {
        $perfiles = $this->perfilModel->orderBy('pe_nombre')->findAll();

        $data = [
            'perfiles' => $perfiles
        ];

        return view('Admin/Menus/index', $data);
    }

    public function dataMenus()
    {
        if ($this->request->isAJAX()) {
            $menus = $this->menuModel->listarMenusNivel1($this->request->getVar('id_perfil'));

            $data = [
                'menus' => $menus
            ];

            $msg = [
                'data' => view('Admin/Menus/dataMenus', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

}