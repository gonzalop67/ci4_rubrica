<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Cursos extends BaseController
{
    public function index()
    {
        return view('Admin/Cursos/index');
    }
}