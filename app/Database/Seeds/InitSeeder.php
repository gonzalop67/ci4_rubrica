<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitSeeder extends Seeder
{
	public function run()
	{
		$this->truncateTablas([
            'sw_area',
            'sw_asignatura',
            'sw_def_genero',
            'sw_def_nacionalidad',
            'sw_dia_semana',
            'sw_escala_calificaciones',
            'sw_especialidad',
            'sw_institucion',
            'sw_jornada',
            'sw_menu',
            'sw_menu_perfil',
            'sw_modalidad',
			'sw_perfil',
            'sw_periodo_estado',
            'sw_quien_inserta_comp',
            'sw_periodo_lectivo',
            'sw_periodo_evaluacion',
            'sw_tipo_aporte',
            'sw_tipo_asignatura',
            'sw_tipo_documento',
            'sw_nivel_educacion',
            'sw_periodo_nivel',
            'sw_tipo_periodo',
            'sw_usuario',
            'sw_usuario_perfil'
        ]);
        $this->call('AreaSeeder');
        $this->call('TipoAsignaturaSeeder');
        $this->call('AsignaturaSeeder');
        $this->call('DefGeneroSeeder');
        $this->call('DefNacionalidadSeeder');
		$this->call('InstitucionSeeder');
		$this->call('JornadaSeeder');
        $this->call('ModalidadSeeder');
		$this->call('PeriodoEstadoSeeder');
        $this->call('QuienInsertaComportamientoSeeder');
        $this->call('PrimerPeriodoLectivoSeeder');
        $this->call('DiaSemanaSeeder');
        $this->call('EscalaCalificacionesSeeder');
        $this->call('NivelEducacionSeeder');
        $this->call('EspecialidadSeeder');
		$this->call('PerfilSeeder');
        $this->call('TipoDocumentoSeeder');
        $this->call('TipoPeriodoSeeder');
        $this->call('PeriodoEvaluacionSeeder');
        $this->call('TipoAporteSeeder');
		$this->call('UsuarioAdministradorSeeder');
        $this->call('MenuAdministradorSeeder');
        $this->call('MenuAutoridadSeeder');
        $this->call('MenuSecretariaSeeder');
        $this->call('MenuDocenteSeeder');
        $this->call('MenuTutorSeeder');
        $this->call('MenuInspeccionSeeder');
        $this->call('MenuDECESeeder');
        $this->call('MenuRepresentanteSeeder');
	}

	protected function truncateTablas(array $tablas)
    {
        $this->db->disableForeignKeyChecks();
        foreach ($tablas as $tabla) {
            $this->db->table($tabla)->truncate();
        }
        $this->db->enableForeignKeyChecks();
    }
}
