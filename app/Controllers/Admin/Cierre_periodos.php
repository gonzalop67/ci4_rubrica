<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CierrePeriodosModel;

class Cierre_periodos extends BaseController
{

    private $cierre_periodos;

    public function __construct()
    {
        $this->cierre_periodos = new CierrePeriodosModel();
    }

    public function index()
    {
        return view('Admin/Cierre_periodos/index');
    }

    public function show()
    {
        echo json_encode($this->cierre_periodos->getCierresPeriodos(session()->id_periodo_lectivo));
    }

}