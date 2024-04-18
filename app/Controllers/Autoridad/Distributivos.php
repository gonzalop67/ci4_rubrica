<?php

namespace App\Controllers\Autoridad;

use App\Controllers\BaseController;
use App\Models\Admin\ParalelosModel;
use App\Models\Admin\UsuariosModel;
use App\Models\Autoridad\DistributivosModel;
use App\Models\Autoridad\MallasCurricularesModel;

class Distributivos extends BaseController
{
    private $usuarioModel;
    private $paraleloModel;
    private $distributivoModel;
    private $mallaCurricularModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuariosModel();
        $this->paraleloModel = new ParalelosModel();
        $this->distributivoModel = new DistributivosModel();
        $this->mallaCurricularModel = new MallasCurricularesModel();
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

    public function store()
    {
        if ($this->request->isAJAX()) {
            if (!$this->validate([
                'id_usuario' => [
                    'label' => 'Docente',
                    'rules' => 'required|is_not_unique[sw_usuario.id_usuario]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ],
                'id_paralelo' => [
                    'label' => 'Paralelo',
                    'rules' => 'required|is_not_unique[sw_paralelo.id_paralelo]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ],
                'id_asignatura' => [
                    'label' => 'Asignatura',
                    'rules' => 'required|is_not_unique[sw_asignatura.id_asignatura]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio',
                        'is_not_unique' => 'No existe ese id para el campo {field}'
                    ]
                ]
            ])) {
                $msg = [
                    'errors' => $this->validator->getErrors()
                ];
            } else {

                $id_periodo_lectivo = session()->id_periodo_lectivo;

                $id_usuario = $this->request->getVar('id_usuario');
                $id_paralelo = $this->request->getVar('id_paralelo');
                $id_asignatura = $this->request->getVar('id_asignatura');

                if ($this->distributivoModel->existeAsociacion($id_paralelo, $id_asignatura)) {
                    $msg = [
                        'error' => 'Ya existe la asociación entre la asignatura y el paralelo en el distributivo.'
                    ];
                } else {

                    //Recupero el id_curso asociado con el id_paralelo
                    $id_curso = $this->paraleloModel->getCursoId($id_paralelo);

                    if ($this->mallaCurricularModel->existeAsociacion($id_curso, $id_asignatura)) {
                        //Ahora recupero el id_malla_curricular asociado con el id_curso y el id_asignatura
                        $id_malla_curricular = $this->mallaCurricularModel->getMallaIdCursoAsignatura($id_curso, $id_asignatura);

                        $this->distributivoModel->save([
                            'id_periodo_lectivo'  => $id_periodo_lectivo,
                            'id_malla_curricular' => $id_malla_curricular,
                            'id_paralelo'         => $id_paralelo,
                            'id_asignatura'       => $id_asignatura,
                            'id_usuario'          => $id_usuario
                        ]);

                        $msg = [
                            'success' => 'El Item del Distributivo se insertó correctamente.'
                        ];
                    } else {
                        $msg = [
                            'error' => 'No se han asociado items a la malla con el paralelo y la asignatura seleccionados...'
                        ];
                    }
                }
            }

            echo json_encode($msg);
        } else {
            exit('Lo siento, no se puede procesar.');
        }
    }

    public function getByUsuarioId()
    {
        $id_usuario = $_POST['id_usuario'];
        $id_periodo_lectivo = session()->id_periodo_lectivo;
        echo json_encode($this->distributivoModel->listarAsignaturasAsociadas($id_usuario, $id_periodo_lectivo));
    }

    public function delete()
    {
        try {
            $this->distributivoModel->delete($this->request->getVar('id'));

            $data = array(
                "title"       => "Operación exitosa.",
                "message"      => "El Item del Distributivo fue eliminado exitosamente.",
                "icon" => "success"
            );
        } catch (\Exception $e) {
            $data = array(
                "title"       => "Ocurrió un error inesperado.",
                "message"      => "El Item del Distributivo no se pudo eliminar...Error: " . $e->getMessage(),
                "icon" => "error"
            );
        }

        echo json_encode($data);
    }
}
