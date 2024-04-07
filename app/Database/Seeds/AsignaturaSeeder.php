<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AsignaturaSeeder extends Seeder
{
	public function run()
	{
		$asignaturas = [
			[
                'id_area' => 1,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'BIOLOGIA',
                'as_abreviatura' => 'BIO',
                'as_shortname' => 'BIOLOGIA'
			],
			[
                'id_area' => 1,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'CIENCIAS NATURALES',
                'as_abreviatura' => 'CCNN',
                'as_shortname' => 'CIENCIAS NATURALES'
			],
			[
                'id_area' => 1,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'FISICA',
                'as_abreviatura' => 'FIS',
                'as_shortname' => 'FISICA'
			],
            [
                'id_area' => 1,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'QUIMICA',
                'as_abreviatura' => 'QUIM',
                'as_shortname' => 'QUIMICA'
			],
            [
                'id_area' => 2,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'EDUCACION PARA LA CIUDADANIA',
                'as_abreviatura' => 'EDU.C.',
                'as_shortname' => 'EDUCACION/CIUDADANIA'
			],
            [
                'id_area' => 2,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'ESTUDIOS SOCIALES',
                'as_abreviatura' => 'EESS',
                'as_shortname' => 'ESTUDIOS SOCIALES'
			],
            [
                'id_area' => 2,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'FILOSOFIA',
                'as_abreviatura' => 'FILO',
                'as_shortname' => 'FILOSOFIA'
			],
            [
                'id_area' => 2,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'HISTORIA',
                'as_abreviatura' => 'HIST',
                'as_shortname' => 'HISTORIA'
			],
            [
                'id_area' => 3,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'EDUCACION CULTURAL Y ARTISTICA',
                'as_abreviatura' => 'ECA',
                'as_shortname' => 'EDUC. CULTURAL Y ARTISTICA'
			],
            [
                'id_area' => 4,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'EDUCACION FISICA',
                'as_abreviatura' => 'EEFF',
                'as_shortname' => 'EDUCACION FISICA'
			],
            [
                'id_area' => 5,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'INGLES',
                'as_abreviatura' => 'ING',
                'as_shortname' => 'INGLES'
			],
            [
                'id_area' => 6,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'LENGUA Y LITERATURA',
                'as_abreviatura' => 'LENGUA',
                'as_shortname' => 'LENGUA Y LITERATURA'
			],
            [
                'id_area' => 7,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'MATEMATICA',
                'as_abreviatura' => 'MATE',
                'as_shortname' => 'MATEMATICA'
			],
            [
                'id_area' => 8,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'EMPRENDIMIENTO Y GESTION',
                'as_abreviatura' => 'EMPRE',
                'as_shortname' => 'EMPRENDIMIENTO Y GESTION'
			],
            [
                'id_area' => 10,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'CONTABILIDAD GENERAL',
                'as_abreviatura' => 'CONTA',
                'as_shortname' => 'CONTABILIDAD GENERAL'
			],
            [
                'id_area' => 10,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'TRIBUTACION',
                'as_abreviatura' => 'TRIB.',
                'as_shortname' => 'TRIBUTACION'
			],
            [
                'id_area' => 10,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'CONTABILIDAD BANCARIA',
                'as_abreviatura' => 'CON.BAN.',
                'as_shortname' => 'CONTABILIDAD BANCARIA'
			],
            [
                'id_area' => 10,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'CONTABILIDAD DE COSTOS',
                'as_abreviatura' => 'COSTOS',
                'as_shortname' => 'CONTABILIDAD DE COSTOS'
			],
            [
                'id_area' => 10,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'PAQUETES CONTABLES Y TRIBUTARIOS',
                'as_abreviatura' => 'PAQ.CON.',
                'as_shortname' => 'PAQUETES CONTABLES'
			],
            [
                'id_area' => 10,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'FORMACION Y ORIENTACION LABORAL',
                'as_abreviatura' => 'FOL',
                'as_shortname' => 'FOL'
			],
            [
                'id_area' => 11,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'APLICACIONES OFIMATICAS LOCALES Y EN LINEA',
                'as_abreviatura' => 'APL.OF.',
                'as_shortname' => 'APLICACIONES OFIMÁTICAS'
			],
            [
                'id_area' => 11,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'SISTEMAS OPERATIVOS Y REDES',
                'as_abreviatura' => 'SIS.OP.',
                'as_shortname' => 'S. OPERATIVOS Y REDES'
			],
            [
                'id_area' => 11,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'PROGRAMACION Y BASES DE DATOS',
                'as_abreviatura' => 'PROG.',
                'as_shortname' => 'PROGRAMACIÓN Y BASE DE DATOS'
			],
            [
                'id_area' => 11,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'SOPORTE TECNICO',
                'as_abreviatura' => 'SOP.TEC.',
                'as_shortname' => 'SOPORTE TÉCNICO'
			],
            [
                'id_area' => 11,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'DISEÑO Y DESARROLLO WEB',
                'as_abreviatura' => 'DIS.WEB',
                'as_shortname' => 'DISEÑO WEB'
			],
            [
                'id_area' => 11,
                'id_tipo_asignatura' => 1,
				'as_nombre' => 'FORMACION Y ORIENTACION LABORAL',
                'as_abreviatura' => 'FOL',
                'as_shortname' => 'FOL'
			],
		];

		$builder = $this->db->table('sw_asignatura');
		$builder->insertBatch($asignaturas);
	}
}
