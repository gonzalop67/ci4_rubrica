<?php

namespace App\Controllers\Secretaria;

use App\Controllers\BaseController;
use App\Models\Secretaria\DefGenerosModel;

class Def_generos extends BaseController
{
    protected $def_generos;

    public function __construct()
    {
        $this->def_generos = new DefGenerosModel();
    }

    public function getAll()
    {
        if ($this->request->isAJAX()) {
            echo $this->def_generos->getAll();
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
