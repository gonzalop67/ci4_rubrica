<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\UsuariosModel;
use App\Models\Admin\PerfilesModel;
use App\Models\Admin\InstitucionModel;
use App\Models\Admin\ModalidadesModel;
use App\Models\Admin\UsuariosPerfilesModel;
use App\Models\Admin\PeriodosLectivosModel;

class Login extends BaseController
{
    private $perfilModel;
    private $modalidadModel;
    private $periodoLectivoModel;

    public function __construct()
    {
        $this->perfilModel = new PerfilesModel();
        $this->modalidadModel = new ModalidadesModel();
        $this->periodoLectivoModel = new PeriodosLectivosModel();
    }

    public function index()
    {
        $institucion = new InstitucionModel();
        $nombreInstitucion = $institucion
            ->where('id_institucion', 1)
            ->first()
            ->in_nombre;

        $modalidades = $this->modalidadModel->listarModalidades();
        $perfiles = $this->perfilModel->orderBy('pe_nombre')->findAll();

        $data = [
            'nombreInstitucion' => $nombreInstitucion,
            'perfiles'          => $perfiles,
            'modalidades'       => $modalidades
        ];

        if (session()->is_logged) {
            return redirect()->to(base_url('/dashboard'));
        } else {
            return view('login', $data);
        }
    }

    public function dashboard()
    {
        $institucion = new InstitucionModel();
        $Institucion = $institucion
            ->where('id_institucion', 1)
            ->first();
        $data = [
            'nomInstitucion'     => $Institucion->in_nombre,
            'urlInstitucion'     => $Institucion->in_url,
        ];
        return view('dashboard', $data);
    }

    public function signin()
    {
        // Método de Autenticación
        if (!$this->validate([
            'usuario' => [
                'label'  => 'Usuario',
                'rules'  => 'required',
                'errors' => [
                    'required'  => 'El campo {field} es obligatorio'
                ],
                'clave' => [
                    'label'  => 'Password',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio'
                    ]
                ],
                'periodo' => [
                    'label'  => 'Periodo Lectivo',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio'
                    ]
                ],
                'perfil' => [
                    'label'  => 'Perfil',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio'
                    ]
                ]
            ]
        ])) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        } else {
            $username = $_POST["usuario"];
            $password = $_POST["clave"];
            $id_perfil = $_POST["perfil"];
            $id_periodo_lectivo = $_POST["periodo"];

            $Usuario = new UsuariosModel();
            $datosUsuario = $Usuario->where('us_login', $username)->first();

            $periodoLectivo = $this->periodoLectivoModel->find($id_periodo_lectivo);

            $id_usuario = $datosUsuario->id_usuario;

            $UsuarioPerfil = new UsuariosPerfilesModel();
            $usuarioPerfil = $UsuarioPerfil
                ->where('id_usuario', $id_usuario)
                ->where('id_perfil', $id_perfil)
                ->first();

            if ($datosUsuario && password_verify($password, $datosUsuario->us_password) && $usuarioPerfil) {

                $nombreUsuario = $datosUsuario->us_shortname;

                $id_periodo_lectivo = $periodoLectivo->id_periodo_lectivo;
                $nom_periodo = $periodoLectivo->pe_anio_inicio . " - " . $periodoLectivo->pe_anio_fin;

                $id_modalidad = $periodoLectivo->id_modalidad;

                // $Modalidad = new ModalidadesModel();
                $modalidad = $this->modalidadModel->find($id_modalidad);

                $Perfil = new PerfilesModel();
                $perfil = $Perfil->find($id_perfil);

                $nombrePerfil = $perfil->pe_nombre;

                $data = [
                    'id_usuario'         => $id_usuario,
                    'nomUsuario'         => $nombreUsuario,
                    'id_perfil'          => $id_perfil,
                    'nomPerfil'          => $nombrePerfil,
                    'id_periodo_lectivo' => $id_periodo_lectivo,
                    'periodo'            => $nom_periodo,
                    'modalidad'          => $modalidad->mo_nombre,
                    'is_logged'          => true
                ];

                $session = session();
                $session->set($data);

                return redirect()->to(base_url('auth/dashboard'));
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('msg', [
                        'type' => 'danger',
                        'icon' => 'ban',
                        'body' => 'El Usuario, Contraseña y/o Perfil son incorrectos.'
                    ]);
            }
        }
    }

    public function signout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
