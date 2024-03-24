<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InstitucionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Institucion extends BaseController
{
    private $institucionModel;

    public function __construct()
    {
        $this->institucionModel = new InstitucionModel();
    }

    public function index()
    {
        if (!$institucion = $this->institucionModel->find(1)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Institucion/index', [
            'institucion' => $institucion
        ]);
    }
}