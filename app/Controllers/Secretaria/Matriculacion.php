<?php

namespace App\Controllers\Secretaria;

use App\Controllers\BaseController;
use App\Models\Admin\ParalelosModel;
use App\Models\Secretaria\DefGenerosModel;
use App\Models\Secretaria\DefNacionalidadesModel;
use App\Models\Secretaria\EstudiantesModel;
use App\Models\Secretaria\EstudiantesPeriodoLectivoModel;
use App\Models\Secretaria\TiposDocumentoModel;

class Matriculacion extends BaseController
{
    private $paraleloModel;
    private $estudianteModel;
    private $defGenerosModel;
    private $tiposDocumentoModel;
    private $defNacionalidadesModel;
    private $estudiantePeriodoLectivoModel;

    public function __construct()
    {
        $this->paraleloModel = new ParalelosModel();
        $this->estudianteModel = new EstudiantesModel();
        $this->defGenerosModel = new DefGenerosModel();
        $this->tiposDocumentoModel = new TiposDocumentoModel();
        $this->defNacionalidadesModel = new DefNacionalidadesModel();
        $this->estudiantePeriodoLectivoModel = new EstudiantesPeriodoLectivoModel();
    }

    public function index()
    {
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

        return view('Secretaria/Matriculacion/index', [
            'paralelos' => $paralelos
        ]);
    }

    public function show()
    {
        $id_paralelo = $this->request->getVar('id_paralelo');

        // echo $id_paralelo;

        echo $this->estudianteModel->listarEstudiantesParalelo($id_paralelo);
    }

    public function formAgregar()
    {
        if ($this->request->isAJAX()) {

            $tipos_documentos =
                $this->tiposDocumentoModel
                ->orderBy('id_tipo_documento')
                ->findAll();

            $def_generos =
                $this->defGenerosModel
                ->orderBy('dg_nombre')
                ->findAll();

            $def_nacionalidades =
                $this->defNacionalidadesModel
                ->orderBy('id_def_nacionalidad')
                ->findAll();

            $data = [
                'def_generos' => $def_generos,
                'tipos_documentos' => $tipos_documentos,
                'def_nacionalidades' => $def_nacionalidades
            ];

            $msg = [
                'data' => view('Secretaria/Matriculacion/modalInsert', $data)
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
                'id_tipo_documento' => [
                    'label' => 'Tipo de Documento',
                    'rules' => 'required|is_not_unique[sw_tipo_documento.id_tipo_documento]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'is_not_unique' => 'No existe el {field} elegido.'
                    ]
                ],
                'dni' => [
                    'label' => 'DNI',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'apellidos' => [
                    'label' => 'Apellidos',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'nombres' => [
                    'label' => 'Nombres',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
                'fec_nac' => [
                    'label' => 'Fecha de nacimiento',
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'valid_date' => 'El campo {field} debe tener un formato de fecha válido'
                    ]
                ],
                'direccion' => [
                    'label' => 'Dirección',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio'
                    ]
                ],
                'sector' => [
                    'label' => 'Sector',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio'
                    ]
                ],
                'telefono' => [
                    'label' => 'Teléfono',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio'
                    ]
                ],
                'genero' => [
                    'label' => 'Género',
                    'rules' => 'required|is_not_unique[sw_def_genero.id_def_genero]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe el {field} elegido.'
                    ]
                ],
                'nacionalidad' => [
                    'label' => 'Nacionalidad',
                    'rules' => 'required|is_not_unique[sw_def_nacionalidad.id_def_nacionalidad]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe el {field} elegido.'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_tipo_documento' => $validation->getError('id_tipo_documento'),
                        'dni' => $validation->getError('dni'),
                        'apellidos' => $validation->getError('apellidos'),
                        'nombres' => $validation->getError('nombres'),
                        'fec_nac' => $validation->getError('fec_nac'),
                        'direccion' => $validation->getError('direccion'),
                        'sector' => $validation->getError('sector'),
                        'telefono' => $validation->getError('telefono'),
                        'genero' => $validation->getError('genero'),
                        'nacionalidad' => $validation->getError('nacionalidad'),
                    ]
                ];
            } else {
                $apellidos = $this->request->getVar('apellidos');
                $nombres = $this->request->getVar('nombres');
                $cedula = $this->request->getVar('dni');
                $data = [
                    'id_tipo_documento' => trim($this->request->getVar('id_tipo_documento')),
                    'id_def_genero' => trim($this->request->getVar('genero')),
                    'id_def_nacionalidad' => $this->request->getVar('nacionalidad'),
                    'es_apellidos' => $apellidos,
                    'es_nombres' => $nombres,
                    'es_nombre_completo' => $apellidos . " " . $nombres,
                    'es_cedula' => $cedula,
                    'es_email' => $this->request->getVar('email'),
                    'es_sector' => $this->request->getVar('sector'),
                    'es_direccion' => $this->request->getVar('direccion'),
                    'es_telefono' => $this->request->getVar('telefono'),
                    'es_fec_nacim' => $this->request->getVar('fec_nac'),
                ];

                $id_periodo_lectivo = session()->id_periodo_lectivo;

                // Primero comprobar si ya existen los nombres y apellidos del estudiante
                if ($this->estudianteModel->existeNombreEstudiante($apellidos, $nombres)) {
                    $msg = array(
                        "titulo"       => "Ocurrió un error inesperado.",
                        "mensaje"      => "Ya existe el estudiante en la base de datos...",
                        "tipo_mensaje" => "error"
                    );
                } elseif ($this->estudianteModel->existeNroCedula($cedula)) {
                    $msg = array(
                        "titulo"       => "Ocurrió un error inesperado.",
                        "mensaje"      => "Ya existe el número de cédula en la base de datos...",
                        "tipo_mensaje" => "error"
                    );
                } else {
                    $this->estudianteModel->insert($data);
                    //Insertar en la tabla sw_estudiante_periodo_lectivo
                    $id_estudiante = $this->estudianteModel->insertID;
                    $datos = [
                        'id_estudiante' => $id_estudiante,
                        'id_periodo_lectivo' => $id_periodo_lectivo,
                        'id_paralelo' => $this->request->getVar('paralelo_id'),
                        'es_estado' => 'N',
                        'es_retirado' => 'N',
                        'nro_matricula' => $this->estudiantePeriodoLectivoModel->getMaxNroMatricula($id_periodo_lectivo) + 1,
                        'activo' => 1
                    ];
                    $this->estudiantePeriodoLectivoModel->insert($datos);
                    $msg = array(
                        "titulo"       => "Operación exitosa.",
                        "mensaje"      => "El estudiante fue insertado exitosamente.",
                        "tipo_mensaje" => "success"
                    );
                }
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }
}
