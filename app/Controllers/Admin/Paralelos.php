<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\CursosModel;
use App\Models\Admin\JornadasModel;
use App\Models\Admin\ParalelosModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Paralelos extends BaseController
{
    private $cursoModel;
    private $jornadaModel;
    private $paraleloModel;

    public function __construct()
    {
        $this->cursoModel = new CursosModel();
        $this->jornadaModel = new JornadasModel();
        $this->paraleloModel = new ParalelosModel();
    }

    public function index()
    {
        return view('Admin/Paralelos/index');
    }

    public function dataParalelos()
    {
        $id_periodo_lectivo = session('id_periodo_lectivo');

        if ($this->request->isAJAX()) {
            $paralelos = $this->paraleloModel
                ->join('sw_curso', 'sw_curso.id_curso = sw_paralelo.id_curso')
                ->join('sw_especialidad', 'sw_especialidad.id_especialidad = sw_curso.id_especialidad')
                ->join('sw_jornada', 'sw_jornada.id_jornada = sw_paralelo.id_jornada')
                ->where('id_periodo_lectivo', $id_periodo_lectivo)->orderBy('pa_orden')->findAll();

            $data = [
                'paralelos' => $paralelos
            ];

            $msg = [
                'data' => view('Admin/Paralelos/dataParalelos', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function create()
    {
        $cursos = $this->cursoModel
            ->join(
                'sw_especialidad',
                'sw_especialidad.id_especialidad = sw_curso.id_especialidad'
            )
            ->join(
                'sw_nivel_educacion',
                'sw_nivel_educacion.id_nivel_educacion = sw_especialidad.id_nivel_educacion'
            )
            ->join(
                'sw_periodo_nivel',
                'sw_nivel_educacion.id_nivel_educacion = sw_periodo_nivel.id_nivel_educacion'
            )
            ->where('sw_periodo_nivel.id_periodo_lectivo', session('id_periodo_lectivo'))
            ->orderBy('cu_orden')
            ->findAll();
        $jornadas = $this->jornadaModel->orderBy('id_jornada')->findAll();
        return view('Admin/Paralelos/create', [
            'cursos' => $cursos,
            'jornadas' => $jornadas
        ]);
    }

    public function store()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[16]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 16 caracteres.'
                ]
            ],
            'id_curso' => 'is_not_unique[sw_curso.id_curso]',
            'id_jornada' => 'is_not_unique[sw_jornada.id_jornada]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Validar si ya existe el nombre del paralelo para el mismo curso y periodo lectivo
        $nombre = trim($this->request->getVar('nombre'));
        $id_curso = $this->request->getVar('id_curso');
        $id_periodo_lectivo = session('id_periodo_lectivo');

        if ($this->paraleloModel->existeParalelo($nombre, $id_curso, $id_periodo_lectivo)) {
            return redirect()->back()->withInput()
                ->with('errors', [
                    'nombre' => 'El nombre del paralelo ya se encuentra utilizado en la base de datos.'
                ]);
        }

        $datos = [
            'id_periodo_lectivo' => $id_periodo_lectivo,
            'id_curso' => $id_curso,
            'id_jornada' => $this->request->getVar('id_jornada'),
            'pa_nombre' => strtoupper($nombre),
            'pa_orden'  => $this->paraleloModel->getNextOrderNumber($id_periodo_lectivo)
        ];

        $this->paraleloModel->save($datos);

        return redirect('paralelos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Paralelo fue insertado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$paralelo = $this->paraleloModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $cursos = $this->cursoModel
            ->join('sw_especialidad', 'sw_especialidad.id_especialidad = sw_curso.id_especialidad')
            ->orderBy('cu_orden')
            ->findAll();
        $jornadas = $this->jornadaModel->orderBy('id_jornada')->findAll();
        return view('Admin/Paralelos/edit', [
            'paralelo' => $paralelo,
            'cursos' => $cursos,
            'jornadas' => $jornadas
        ]);
    }

    public function update()
    {
        if (!$this->validate([
            'nombre' => [
                'label' => 'Nombre',
                'rules' => 'required|max_length[16]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no debe exceder los 16 caracteres.'
                ]
            ],
            'id_curso' => 'is_not_unique[sw_curso.id_curso]',
            'id_jornada' => 'is_not_unique[sw_jornada.id_jornada]'
        ])) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Validar si ya existe el nombre del paralelo para el mismo curso y periodo lectivo
        $nombre = trim($this->request->getVar('nombre'));
        $id_curso = $this->request->getVar('id_curso');
        $id_periodo_lectivo = session('id_periodo_lectivo');

        $id_paralelo = $this->request->getVar('id_paralelo');
        $paralelo = $this->paraleloModel->find($id_paralelo);

        if ($paralelo->pa_nombre != $nombre && $this->paraleloModel->existeParalelo($nombre, $id_curso, $id_periodo_lectivo)) {
            return redirect()->back()->withInput()
                ->with('errors', [
                    'nombre' => 'El nombre del paralelo ya se encuentra utilizado en la base de datos.'
                ]);
        }

        $datos = [
            'id_paralelo' => $id_paralelo,
            'id_curso' => $id_curso,
            'id_jornada' => $this->request->getVar('id_jornada'),
            'pa_nombre' => strtoupper($nombre)
        ];

        $this->paraleloModel->save($datos);

        return redirect('paralelos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El Paralelo fue actualizado correctamente.'
        ]);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');

            try {
                $this->paraleloModel->delete($id);

                $msg = [
                    'success' => true,
                    'icon'    => "success",
                    'message' => "El Paralelo fue eliminado correctamente."
                ];
            } catch (\Exception $e) {
                $msg = [
                    'success' => false,
                    'icon'    => "error",
                    'message' => "No se puede eliminar El Paralelo porque tiene registros relacionados en otras tablas."
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

                $this->paraleloModel->actualizarOrden($index, $newPosition);
            }
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
