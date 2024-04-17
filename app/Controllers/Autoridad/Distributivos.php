<?php

namespace App\Controllers\Autoridad;

use App\Controllers\BaseController;
use App\Models\Admin\ParalelosModel;
use App\Models\Admin\UsuariosModel;

class Distributivos extends BaseController
{
    private $usuarioModel;
    private $paraleloModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuariosModel();
        $this->paraleloModel = new ParalelosModel();
    }

    public function index()
    {
        $usuarios = $this->usuarioModel
            ->select(
                'sw_usuario.id_usuario,
                    sw_usuario.us_titulo,
                    sw_usuario.us_apellidos,
                    sw_usuario.us_nombres'
            )
            ->join(
                'sw_usuario_perfil',
                'sw_usuario.id_usuario = sw_usuario_perfil.id_usuario'
            )
            ->join(
                'sw_perfil',
                'sw_perfil.id_perfil = sw_usuario_perfil.id_perfil'
            )
            ->where('pe_nombre', 'Docente')
            ->where('us_activo', 1)
            ->orderBy('us_apellidos')
            ->orderBy('us_nombres')
            ->findAll();

        $paralelos = $this->paraleloModel
            ->join(
                'sw_curso',
                'sw_curso.id_curso = sw_paralelo.id_curso'
            )
            ->join(
                'sw_especialidad',
                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
            )
            ->join(
                'sw_jornada',
                'sw_jornada.id_jornada = sw_paralelo.id_jornada'
            )
            ->where('id_periodo_lectivo', session('id_periodo_lectivo'))
            ->orderBy('pa_orden')
            ->findAll();

        return view('Autoridad/Distributivos/index', [
            'usuarios' => $usuarios,
            'paralelos' => $paralelos
        ]);
    }
}
