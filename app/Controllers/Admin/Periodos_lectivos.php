<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\ModalidadesModel;
use App\Models\Admin\NivelesEducacionModel;
use App\Models\Admin\PeriodosLectivosModel;
use App\Models\Admin\PeriodosNivelesModel;
use App\Models\Admin\SubPeriodosPeriodoModel;
use App\Models\Admin\SubPeriodosEvaluacionModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Periodos_lectivos extends BaseController
{
    private $modalidadModel;
    private $subPeriodoModel;
    private $periodoNivelModel;
    private $periodoLectivoModel;
    private $nivelEducacionModel;
    private $subPeriodosPeriodoModel;
    private $subPeriodosEvaluacionModel;

    public function __construct()
    {
        $this->modalidadModel = new ModalidadesModel();
        $this->periodoNivelModel = new PeriodosNivelesModel();
        $this->periodoLectivoModel = new PeriodosLectivosModel();
        $this->nivelEducacionModel = new NivelesEducacionModel();
        $this->subPeriodoModel = new SubPeriodosEvaluacionModel();
        $this->subPeriodosPeriodoModel = new SubPeriodosPeriodoModel();
        $this->subPeriodosEvaluacionModel = new SubPeriodosEvaluacionModel();
    }

    public function index()
    {
        $periodos_lectivos = $this->periodoLectivoModel->listarPeriodosLectivos();

        $data = [
            'periodos_lectivos' => $periodos_lectivos
        ];

        return view('Admin/Periodos_lectivos/index', $data);
    }

    public function create()
    {
        $modalidades = $this->modalidadModel->listarModalidades();
        $niveles = $this->nivelEducacionModel->findAll();
        $sub_periodos = $this->subPeriodoModel->findAll();

        $data = [
            'modalidades'  => $modalidades,
            'niveles'      => $niveles,
            'sub_periodos' => $sub_periodos
        ];

        return view('Admin/Periodos_lectivos/create', $data);
    }

    public function store()
    {
        $pe_anio_inicio = $this->request->getVar('pe_anio_inicio');
        $max_anio_inicio = $this->periodoLectivoModel->obtenerMaxAnioInicio();

        // dd($this->request->getPost());

        if (!$this->validate([
            'pe_anio_inicio' => [
                'label' => 'Año Inicial',
                'rules' => 'required|integer|greater_than_equal_to[' . $max_anio_inicio . ']',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'integer' => 'El campo {field} debe ser un número entero',
                    'greater_than_equal_to' => 'El {field} no puede ser menor que el máximo año de inicio en la BD'
                ]
            ],
            'pe_anio_fin' => [
                'label' => 'Año Final',
                'rules' => 'required|integer|greater_than_equal_to[' . $pe_anio_inicio . ']',
                'errors' => [
                    'required'  => 'El campo {field} es obligatorio',
                    'integer'   => 'El campo {field} debe ser un número entero',
                    'greater_than_equal_to' => 'El {field} no puede ser menor que el Año Inicial'
                ]
            ],
            'pe_fecha_inicio' => [
                'label' => 'Fecha de inicio',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                ]
            ],
            'pe_fecha_fin' => [
                'label' => 'Fecha de fin',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                ]
            ],
            'pe_nota_minima' => [
                'label' => 'Nota Mínima',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'numeric' => 'El campo {field} debe ser numérico',
                    'greater_than' => 'La {field} no puede ser menor que cero'
                ]
            ],
            'id_modalidad' => [
                'label' => 'Modalidad',
                'rules' => 'required|is_not_unique[sw_modalidad.id_modalidad]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'is_not_unique' => 'No existe esa {field} en la base de datos'
                ]
            ]
        ])) {
            // dd($this->validator->getErrors());
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Tienes campos incorrectos'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        // Comprobar que se han pasado los niveles de educación a asociar al nuevo periodo lectivo
        $niveles = $this->request->getVar('niveles');

        if ($niveles == null) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'danger',
                'icon' => 'exclamation-triangle',
                'body' => 'Debe seleccionar al menos un nivel de educación a relacionar...'
            ]);
        }

        // Comprobar que se han pasado los sub periods de evaluación a asociar al nuevo periodo lectivo
        $sub_periodos = $this->request->getVar('sub_periodos');

        if ($sub_periodos == null) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'danger',
                'icon' => 'exclamation-triangle',
                'body' => 'Debe seleccionar al menos un sub periodo de evaluación a relacionar...'
            ]);
        }

        $datos = [
            'id_periodo_estado' => 1,
            'id_modalidad' => trim($this->request->getVar('id_modalidad')),
            'pe_anio_inicio'  => trim($this->request->getVar('pe_anio_inicio')),
            'pe_anio_fin'  => trim($this->request->getVar('pe_anio_fin')),
            'pe_fecha_inicio'  => trim($this->request->getVar('pe_fecha_inicio')),
            'pe_fecha_fin'  => trim($this->request->getVar('pe_fecha_fin')),
            'pe_nota_minima' => trim($this->request->getVar('pe_nota_minima')),
            'pe_nota_aprobacion' => trim($this->request->getVar('pe_nota_aprobacion')),
        ];

        $this->periodoLectivoModel->save($datos);

        // Relacionar los niveles de educación con el nuevo periodo lectivo
        $id_periodo_lectivo = $this->periodoLectivoModel->getInsertID();

        for ($i = 0; $i < count($niveles); $i++) {
            $this->periodoNivelModel->save([
                'id_periodo_lectivo' => $id_periodo_lectivo,
                'id_nivel_educacion' => $niveles[$i]
            ]);
        }

        for ($i = 0; $i < count($sub_periodos); $i++) {
            $this->subPeriodosPeriodoModel->save([
                'id_periodo_lectivo' => $id_periodo_lectivo,
                'id_sub_periodo_evaluacion' => $sub_periodos[$i]
            ]);
        }

        return redirect('periodos_lectivos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El periodo lectivo fue creado correctamente.'
        ]);
    }

    public function edit(string $id)
    {
        if (!$periodo_lectivo = $this->periodoLectivoModel->find($id)) {
            throw PageNotFoundException::forPageNotFound();
        }

        $modalidades = $this->modalidadModel->listarModalidades();

        $niveles = $this->nivelEducacionModel->findAll();
        $periodosNiveles = $this->periodoNivelModel->where('id_periodo_lectivo', $id)->findAll();
        $subPeriodosEvaluacion = $this->subPeriodosEvaluacionModel->findAll();
        $subPeriodosPeriodo = $this->subPeriodosPeriodoModel->where('id_periodo_lectivo', $id)->findAll();

        return view('Admin/Periodos_lectivos/edit', [
            'periodo_lectivo' => $periodo_lectivo,
            'modalidades'     => $modalidades,
            'niveles'         => $niveles,
            'periodosNiveles' => $periodosNiveles, 
            'subPeriodosEval' => $subPeriodosEvaluacion, 
            'subPeriodosPeriodoEval' => $subPeriodosPeriodo
        ]);
    }

    public function update()
    {
        $pe_anio_inicio = $this->request->getVar('pe_anio_inicio');
        $max_anio_inicio = $this->periodoLectivoModel->obtenerMaxAnioInicio();

        if (!$this->validate([
            'pe_anio_inicio' => [
                'label' => 'Año Inicial',
                'rules' => 'required|integer|greater_than_equal_to[' . $max_anio_inicio . ']',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'integer' => 'El campo {field} debe ser un número entero',
                    'greater_than_equal_to' => 'El {field} no puede ser menor que el máximo año de inicio en la BD'
                ]
            ],
            'pe_anio_fin' => [
                'label' => 'Año Final',
                'rules' => 'required|integer|greater_than_equal_to[' . $pe_anio_inicio . ']',
                'errors' => [
                    'required'  => 'El campo {field} es obligatorio',
                    'integer'   => 'El campo {field} debe ser un número entero',
                    'greater_than_equal_to' => 'El {field} no puede ser menor que el Año Inicial'
                ]
            ],
            'pe_fecha_inicio' => [
                'label' => 'Fecha de inicio',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                ]
            ],
            'pe_fecha_fin' => [
                'label' => 'Fecha de fin',
                'rules' => 'required|valid_date[Y-m-d]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                ]
            ],
            'pe_nota_minima' => [
                'label' => 'Nota Mínima',
                'rules' => 'required|numeric|greater_than[0]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'numeric' => 'El campo {field} debe ser numérico',
                    'greater_than' => 'La {field} no puede ser menor que cero'
                ]
            ],
        ])) {
            return redirect()->back()->withInput()
                ->with('msg', [
                    'type' => 'danger',
                    'body' => 'Tienes campos incorrectos'
                ])
                ->with('errors', $this->validator->getErrors());
        }

        // Comprobar que se han pasado los niveles de educación a asociar al nuevo periodo lectivo
        $niveles = $this->request->getVar('niveles');

        if ($niveles == null) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'danger',
                'icon' => 'exclamation-triangle',
                'body' => 'Debe seleccionar al menos un nivel de educación a relacionar...'
            ]);
        }

        // Comprobar que se han pasado los niveles de educación a asociar al nuevo periodo lectivo
        $sub_periodos = $this->request->getVar('sub_periodos');

        if ($sub_periodos == null) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'danger',
                'icon' => 'exclamation-triangle',
                'body' => 'Debe seleccionar al menos un sub periodo de evaluación a relacionar...'
            ]);
        }

        $id_periodo_lectivo = $this->request->getVar('id_periodo_lectivo');

        $datos = [
            'id_periodo_lectivo' => $id_periodo_lectivo,
            'pe_anio_inicio'  => trim($this->request->getVar('pe_anio_inicio')),
            'pe_anio_fin'  => trim($this->request->getVar('pe_anio_fin')),
            'pe_fecha_inicio'  => trim($this->request->getVar('pe_fecha_inicio')),
            'pe_fecha_fin'  => trim($this->request->getVar('pe_fecha_fin')),
            'pe_nota_minima' => trim($this->request->getVar('pe_nota_minima')),
            'pe_nota_aprobacion' => trim($this->request->getVar('pe_nota_aprobacion')),
        ];

        $this->periodoLectivoModel->save($datos);

        // Actualizar los niveles de educación asociados
        // Primero eliminar los niveles de educación asociados actualmente
        $this->periodoNivelModel->where('id_periodo_lectivo', $id_periodo_lectivo)->delete();
        // Ahora insertar los niveles de educación enviados mediante POST
        for ($i = 0; $i < count($niveles); $i++) {
            $datos = [
                'id_periodo_lectivo' => $id_periodo_lectivo,
                'id_nivel_educacion' => $niveles[$i]
            ];
            $this->periodoNivelModel->insert($datos);
        }

        // Actualizar los sub periodos de evaluación asociados
        // Primero eliminar los sub periodos de evaluación asociados actualmente
        $this->subPeriodosPeriodoModel->where('id_periodo_lectivo', $id_periodo_lectivo)->delete();
        // Ahora insertar los perfiles enviados mediante POST
        for ($i = 0; $i < count($sub_periodos); $i++) {
            $datos = [
                'id_periodo_lectivo' => $id_periodo_lectivo,
                'id_sub_periodo_evaluacion' => $sub_periodos[$i]
            ];
            $this->subPeriodosPeriodoModel->insert($datos);
        }

        return redirect('periodos_lectivos')->with('msg', [
            'type' => 'success',
            'icon' => 'check',
            'body' => 'El periodo lectivo fue actualizado correctamente.'
        ]);
    }
}
