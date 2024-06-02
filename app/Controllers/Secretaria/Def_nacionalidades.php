<?php

namespace App\Controllers\Secretaria;

use App\Controllers\BaseController;
use App\Models\Secretaria\DefNacionalidadesModel;

class Def_nacionalidades extends BaseController
{
    protected $def_nacionalidades;

    public function __construct()
    {
        $this->def_nacionalidades = new DefNacionalidadesModel();
    }

    public function getAll()
    {
        if ($this->request->isAJAX()) {
            echo $this->def_nacionalidades->getAll();
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
