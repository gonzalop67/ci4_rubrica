<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\PerfilesModel;

class Perfiles extends BaseController
{
    private $perfilModel;

    public function __construct()
    {
        $this->perfilModel = new PerfilesModel();
    }

    public function index()
    {
        $data = [
            'perfiles' => $this->perfilModel->orderBy('pe_nombre')->findAll()
        ];

        return view('Admin/Perfiles/index', $data);
    }
}
