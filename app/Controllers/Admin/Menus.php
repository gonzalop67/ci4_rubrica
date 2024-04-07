<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MenusModel;
use App\Models\Admin\MenusPerfilesModel;
use App\Models\Admin\PerfilesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Menus extends BaseController
{
    private $menuModel;
    private $perfilModel;
    private $menuPerfilModel;

    public function __construct()
    {
        $this->menuModel = new MenusModel();
        $this->perfilModel = new PerfilesModel();
        $this->menuPerfilModel = new MenusPerfilesModel();
    }

    public function index()
    {
        $perfiles = $this->perfilModel->orderBy('pe_nombre')->findAll();

        $data = [
            'perfiles' => $perfiles
        ];

        return view('Admin/Menus/index', $data);
    }

    public function dataMenus()
    {
        if ($this->request->isAJAX()) {
            $menus = $this->menuModel->listarMenusNivel1($this->request->getVar('id_perfil'));

            $data = [
                'menus' => $menus
            ];

            $msg = [
                'data' => view('Admin/Menus/dataMenus', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('Admin/Menus/modalInsert')
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'texto' => [
                    'label' => 'Texto',
                    'rules' => 'required|max_length[32]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'max_length' => 'El campo {field} no debe exceder los 32 caracteres.',
                    ]
                ],
                'enlace' => [
                    'label' => 'Enlace',
                    'rules' => 'required|max_length[64]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'max_length' => 'El campo {field} no debe exceder los 64 caracteres.',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'texto' => $validation->getError('texto'),
                        'enlace' => $validation->getError('enlace')
                    ]
                ];
            } else {
                $data = [
                    'mnu_texto' => trim($this->request->getVar('texto')),
                    'mnu_link' => trim($this->request->getVar('enlace')),
                    'mnu_nivel' => 1,
                    'mnu_publicado' => $this->request->getVar('publicado'),
                ];

                $this->menuModel->save($data);

                $id_menu = $this->menuModel->getInsertID();

                $this->menuPerfilModel->save([
                    'id_menu' => $id_menu,
                    'id_perfil' => $this->request->getVar('perfil_id')
                ]);

                $msg = [
                    'success' => 'El Menú fue insertado exitosamente.'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function edit()
    {
        if ($this->request->isAJAX()) {
            $id_menu = $this->request->getVar('id_menu');

            $row = $this->menuModel->find($id_menu);

            $data = [
                'id_menu' => $row->id_menu,
                'texto' => $row->mnu_texto,
                'enlace' => $row->mnu_link,
                'publicado' => $row->mnu_publicado,
            ];

            $msg = [
                'success' => view('Admin/Menus/modalEdit', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function update()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'texto' => [
                    'label' => 'Texto',
                    'rules' => 'required|max_length[32]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'max_length' => 'El campo {field} no debe exceder los 32 caracteres.',
                    ]
                ],
                'enlace' => [
                    'label' => 'Enlace',
                    'rules' => 'required|max_length[64]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'max_length' => 'El campo {field} no debe exceder los 64 caracteres.',
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'texto' => $validation->getError('texto'),
                        'enlace' => $validation->getError('enlace')
                    ]
                ];
            } else {
                $data = [
                    'id_menu' => $this->request->getVar('id_menu'),
                    'mnu_texto' => trim($this->request->getVar('texto')),
                    'mnu_link' => trim($this->request->getVar('enlace')),
                    'mnu_publicado' => $this->request->getVar('publicado'),
                ];

                $this->menuModel->save($data);

                $msg = [
                    'success' => 'El Menú fue actualizado exitosamente.'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id_menu = $this->request->getVar('id_menu');

            if (count($this->menuModel->listarMenusHijos($id_menu)) > 0) {
                $msg = [
                    'icon'    => "error",
                    'message' => "El Menú no se puede eliminar porque tiene menús hijos asociados."
                ];
            } else {
                try {
                    $this->menuModel->delete($id_menu);
    
                    $msg = [
                        'success' => true,
                        'icon'    => "success",
                        'message' => "El Menú fue eliminado correctamente."
                    ];
                } catch (\Exception $e) {
                    $msg = [
                        'icon'    => "error",
                        'message' => "El Menú no se puede eliminar porque tiene registros asociados en otras tablas."
                    ];
                }
            }
            
            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function guardarOrden()
    {
        if ($this->request->isAJAX()) {
            $this->menuModel->guardarOrden($this->request->getVar('menu'));

            echo json_encode(['respuesta' => 'ok']);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
