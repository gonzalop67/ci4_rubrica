<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\InstitucionModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

class Institucion extends BaseController
{
    private $institucionModel;

    public function __construct()
    {
        $this->institucionModel = new InstitucionModel();
    }

    public function index()
    {
        if (!$institucion = $this->institucionModel->find(1)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('Admin/Institucion/index', [
            'institucion' => $institucion
        ]);
    }

    public function update()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => "required|max_length[64]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'direccion' => [
                'label' => 'Dirección',
                'rules' => "required|max_length[64]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'telefono' => [
                'label' => 'Teléfono',
                'rules' => "required|max_length[64]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'regimen' => [
                'label' => 'Régimen',
                'rules' => "required|max_length[45]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 45 caracteres.'
                ]
            ],
            'rector' => [
                'label' => 'Rector',
                'rules' => "required|max_length[45]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 45 caracteres.'
                ]
            ],
            'vicerrector' => [
                'label' => 'Vicerrector',
                'rules' => "required|max_length[45]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 45 caracteres.'
                ]
            ],
            'secretario' => [
                'label' => 'Secretario',
                'rules' => "required|max_length[45]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 45 caracteres.'
                ]
            ],
            'url' => [
                'label' => 'URL',
                'rules' => "required|max_length[64]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'amie' => [
                'label' => 'AMIE',
                'rules' => "required|max_length[16]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 16 caracteres.'
                ]
            ],
            'ciudad' => [
                'label' => 'Ciudad',
                'rules' => "required|max_length[64]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
                ],
                'logo' => [
                    'label'  => 'Logo',
                    'rules'  => 'permit_empty|is_image[logo]',
                    'errors' => [
                        'is_image' => 'Debe subir un archivo de imagen.'
                    ]
                ]
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('logo');

        if ($file->getClientName() != "") {

            $logo = $file->getRandomName();

            $file->store("avatars/", $logo);
        } else {
            $logo = $this->request->getVar('imagen_institucion_oculta');
        }

        $data = [
            'id_institucion' => 1,
            'in_nombre' => $this->request->getVar('nombre'),
            'in_direccion' => $this->request->getVar('direccion'),
            'in_telefono' => $this->request->getVar('telefono'),
            'in_regimen' => $this->request->getVar('regimen'),
            'in_nom_rector' => $this->request->getVar('rector'),
            'in_genero_rector' => $this->request->getVar('rector_genero'),
            'in_nom_vicerrector' => $this->request->getVar('vicerrector'),
            'in_genero_vicerrector' => $this->request->getVar('vicerrector_genero'),
            'in_nom_secretario' => $this->request->getVar('secretario'),
            'in_genero_secretario' => $this->request->getVar('secretario_genero'),
            'in_url' => $this->request->getVar('url'),
            'in_logo' => $logo,
            'in_amie' => $this->request->getVar('amie'),
            'in_ciudad' => $this->request->getVar('ciudad')
        ];

        $this->institucionModel->save($data);

        return redirect('institucion')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'Los datos de la institución se actualizaron correctamente.'
        ]);
    }

    public function actualizar_estado_copiar_y_pegar()
    {
        $in_copiar_y_pegar = $_POST['in_copiar_y_pegar'];
        try {
            $this->institucionModel->actualizar_copiar_y_pegar($in_copiar_y_pegar);
            $data = [
                "titulo"       => "Actualización exitosa.",
                "mensaje"      => "El estado copiar y pegar fue actualizado exitosamente.",
                "tipo_mensaje" => "success"
            ];

            echo json_encode($data);
        } catch (Exception $ex) {
            $data = [
                "titulo"       => "Exception!",
                "mensaje"      => "El estado copiar y pegar no fue actualizado exitosamente. Error: " . $ex->getMessage(),
                "tipo_mensaje" => "error"
            ];

            echo json_encode($data);
        }
    }
}
