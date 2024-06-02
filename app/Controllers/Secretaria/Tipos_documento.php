<?php

namespace App\Controllers\Secretaria;

use App\Controllers\BaseController;
use App\Models\Secretaria\TiposDocumentoModel;

class Tipos_documento extends BaseController
{
    protected $tipos_documento;

    public function __construct()
    {
        $this->tipos_documento = new TiposDocumentoModel();
    }

    public function getAll()
    {
        if ($this->request->isAJAX()) {
            echo $this->tipos_documento->getAll();
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
