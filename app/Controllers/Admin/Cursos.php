<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CursosModel;
use App\Models\Admin\EspecialidadesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Cursos extends BaseController
{
    private $cursoModel;
    private $especialidadModel;

    public function __construct()
    {
        $this->cursoModel = new CursosModel();
        $this->especialidadModel = new EspecialidadesModel();
    }

    public function index()
    {
        return view('Admin/Cursos/index');
    }

    public function dataCursos()
    {
        if ($this->request->isAJAX()) {
            $cursos = $this->cursoModel->orderBy('cu_orden')->findAll();

            $data = [
                'cursos' => $cursos
            ];

            $msg = [
                'data' => view('Admin/Cursos/dataCursos', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        $especialidades = $this->especialidadModel->orderBy('es_orden')->findAll();
        return view('Admin/Cursos/create', [
            'especialidades' => $especialidades
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'abreviatura' => [
                'label' => 'Abreviatura',
                'rules' => 'required|max_length[45]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 45 caracteres.'
                ]
            ],
            'nombre_corto' => [
                'label' => 'Nombre Corto',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'id_especialidad' => 'is_not_unique[sw_especialidad.id_especialidad]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Validar si se repite el nombre del curso para la misma especialidad
        $nombre = trim($this->request->getVar('nombre'));
        $id_especialidad = $this->request->getVar('id_especialidad');

        if ($this->cursoModel->existeCurso($nombre, $id_especialidad)) {
            return redirect()->back()->withInput()
                ->with('errors', [
                    'nombre' => 'El nombre del curso ya se encuentra utilizado para la figura elegida.'
                ]);
        }

        $datos = [
            'id_especialidad' => $this->request->getVar('id_especialidad'),
            'cu_nombre' => $nombre,
            'cu_shortname' => trim($this->request->getVar('nombre_corto')),
            'cu_abreviatura' => trim($this->request->getVar('abreviatura')),
            'es_bach_tecnico' => $this->request->getVar('es_bach_tecnico'),
            'es_intensivo' => $this->request->getVar('es_intensivo'),
            'cu_orden'  => $this->cursoModel->getNextOrderNumber()
        ];

        $this->cursoModel->save($datos);

        return redirect('cursos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Curso fue guardado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$curso = $this->cursoModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $especialidades = $this->especialidadModel->orderBy('es_orden')->findAll();
        return view('Admin/Cursos/edit', [
            'curso' => $curso,
            'especialidades' => $especialidades
        ]);
    }

    public function update()
    {
        $id_curso = $this->request->getVar('id_curso');

        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => "required|max_length[64]",
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'abreviatura' => [
                'label' => 'Abreviatura',
                'rules' => 'required|max_length[45]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 45 caracteres.'
                ]
            ],
            'nombre_corto' => [
                'label' => 'Nombre Corto',
                'rules' => 'required|max_length[64]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 64 caracteres.'
                ]
            ],
            'id_especialidad' => 'is_not_unique[sw_especialidad.id_especialidad]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $datos = [
            'id_curso' => $id_curso,
            'id_especialidad' => $this->request->getVar('id_especialidad'),
            'cu_nombre' => trim($this->request->getVar('nombre')),
            'cu_abreviatura' => trim($this->request->getVar('abreviatura')),
            'cu_shortname' => trim($this->request->getVar('nombre_corto')),
            'es_bach_tecnico' => $this->request->getVar('es_bach_tecnico'),
            'es_intensivo' => $this->request->getVar('es_intensivo')
        ];

        $this->cursoModel->save($datos);

        return redirect('cursos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Curso fue actualizado correctamente.'
        ]);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            try {
                $this->cursoModel->delete($id);

                $msg = [
                    'success' => true,
                    'icon'    => "success",
                    'message' => "El Curso fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'success' => false,
                    'icon'    => "error",
                    'message' => "No se puede eliminar El Curso porque tiene registros relacionados en otras tablas."
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function saveNewPositions()
    {
        if ($this->request->isAJAX()) {
            foreach ($_POST['positions'] as $position) {
                $index = $position[0];
                $newPosition = $position[1];

                $this->cursoModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
