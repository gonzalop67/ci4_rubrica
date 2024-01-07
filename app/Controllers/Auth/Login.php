<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\Admin\UsuariosModel;
use App\Models\Admin\InstitucionModel;
class Login extends BaseController
{
    public function index()
    {
        $institucion = new InstitucionModel();
        $nombreInstitucion = $institucion
            ->where('id_institucion', 1)
            ->first()
            ->in_nombre;

        $data = [
            'nombreInstitucion' => $nombreInstitucion
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
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            return redirect()->to(base_url('/'))
                ->with('msg', [
                    'type' => 'danger',
                    'icon' => 'ban',
                    'body' => 'Los campos están vacíos..'
                ]);
        } else {
            $username = $_POST["usuario"];
            $password = $_POST["clave"];

            $Usuario = new UsuariosModel();
            $datosUsuario = $Usuario->where('us_login', $username)->first();

            if ($datosUsuario && password_verify($password, $datosUsuario->us_password)) {
                $id_usuario = $datosUsuario->id_usuario;
                
                $data = [
                    'id_usuario' => $id_usuario,
                ];

                $session = session();
                $session->set($data);

                return redirect()->to(base_url('auth/dashboard'));
            } else {
                return redirect()->to(base_url('/'))
                    ->with('msg', [
                        'type' => 'danger',
                        'icon' => 'ban',
                        'body' => 'El Usuario y/o Contraseña son incorrectos.'
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
