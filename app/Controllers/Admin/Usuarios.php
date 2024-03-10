<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\UsuariosModel;
use App\Models\Admin\PerfilesModel;
use App\Models\Admin\UsuariosPerfilesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Usuarios extends BaseController
{
    private $usuariosModel;
    private $perfilesModel;
    private $usuariosPerfilesModel;

    public function __construct()
    {
        $this->usuariosModel = new UsuariosModel();
        $this->perfilesModel = new PerfilesModel();
        $this->usuariosPerfilesModel = new UsuariosPerfilesModel();
    }

    public function index()
    {
        return view('Admin/Usuarios/index');
    }

    public function dataUsuarios()
    {
        if ($this->request->isAJAX()) {
            $usuarios = $this->usuariosModel->orderBy('us_apellidos')->orderBy('us_nombres')->findAll();

            $data = [
                'usuarios' => $usuarios
            ];

            $msg = [
                'data' => view('Admin/Usuarios/dataUsuarios', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        $perfiles = $this->perfilesModel->orderBy('pe_nombre')->findAll();
        return view('Admin/Usuarios/create', [
            'perfiles' => $perfiles
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'abreviatura' => [
                'label'  => 'Abreviatura',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'descripcion' => [
                'label'  => 'Descripción del Título',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'apellidos' => [
                'label'  => 'Apellidos',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'nombres' => [
                'label'  => 'Nombres',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'nombre_corto' => [
                'label'  => 'Nombre Corto',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'usuario' => [
                'label'  => 'Usuario',
                'rules'  => 'required|is_unique[sw_usuario.us_login]',
                'errors' => [
                    'required'  => 'El campo {field} es obligatorio',
                    'is_unique' => 'El campo {field} tiene que contener un valor único'
                ]
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'perfiles.*' => 'permit_empty|is_not_unique[sw_perfil.id_perfil]',
            'foto' => [
                'label'  => 'Avatar',
                'rules'  => 'uploaded[foto]|is_image[foto]',
                'errors' => [
                    'uploaded' => 'El campo {field} es obligatorio.',
                    'is_image' => 'Debe subir un archivo de imagen.'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('foto');
        $foto = $file->getRandomName();

        $data = [
            'us_titulo' => $this->request->getVar('abreviatura'),
            'us_titulo_descripcion' => $this->request->getVar('descripcion'),
            'us_apellidos' => $this->request->getVar('apellidos'),
            'us_nombres' => $this->request->getVar('nombres'),
            'us_shortname' => $this->request->getVar('nombre_corto'),
            'us_fullname' => $this->request->getVar('apellidos') . " " . $this->request->getVar('nombres'),
            'us_login' => $this->request->getVar('usuario'),
            'us_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'us_foto' => $foto,
            'us_genero' => $this->request->getVar('genero'),
            'us_activo' => $this->request->getVar('activo')
        ];

        $this->usuariosModel->save($data);

        // Relacionar los perfiles con el nuevo usuario
        $perfiles = $this->request->getVar('perfiles');
        $id_usuario = $this->usuariosModel->getInsertID();

        $usuariosPerfilesModel = new UsuariosPerfilesModel();

        for ($i = 0; $i < count($perfiles); $i++) {
            $usuariosPerfilesModel->save([
                'id_usuario' => $id_usuario,
                'id_perfil' => $perfiles[$i]
            ]);
        }

        $file->store("avatars/", $foto);

        return redirect('usuarios')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Usuario fue ingresado correctamente.'
        ]);
    }

    public function edit($id)
    {
        if (!$usuario = $this->usuariosModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $perfiles = $this->perfilesModel->orderBy('pe_nombre')->findAll();
        $perfilesUsuario = $this->usuariosPerfilesModel->where('id_usuario', $id)->findAll();

        return view('Admin/Usuarios/edit', [
            'usuario' => $usuario,
            'perfiles' => $perfiles,
            'perfilesUsuario' => $perfilesUsuario
        ]);
    }
}
