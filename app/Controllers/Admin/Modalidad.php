<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InstitucionModel;
use App\Models\Admin\ModalidadesModel;

class Modalidad extends BaseController
{
    public function index()
    {
        $institucion = new InstitucionModel();
        $Institucion = $institucion
            ->where('id_institucion', 1)
            ->first();
        $model = new ModalidadesModel();
        $modalidades = $model->listarModalidades();
        $data = [
            'nomInstitucion' => $Institucion->in_nombre,
            'urlInstitucion' => $Institucion->in_url,
            'modalidades'    => $modalidades
        ];

        return view('Admin/Modalidades/index', $data);
    }
}
