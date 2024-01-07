<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuDocenteSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
            [
				'mnu_texto'     => 'Calificaciones', // id_menu = 62
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Asistencia', // id_menu = 63
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Informes', // id_menu = 64
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Reportes', // id_menu = 65
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Listas', // id_menu = 66
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 5,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Parciales', // id_menu = 67
                'mnu_link'      => 'docentes/parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 62,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Supletorios', // id_menu = 68
                'mnu_link'      => 'docentes/supletorios',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 62,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Remediales', // id_menu = 69
                'mnu_link'      => 'docentes/remdiales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 62,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Gracia', // id_menu = 70
                'mnu_link'      => 'docentes/de_gracia',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 62,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Ingresar Asistencia', // id_menu = 71
                'mnu_link'      => 'docentes/asistencia',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 63,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Ver Horario', // id_menu = 72
                'mnu_link'      => 'docentes/horario',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 63,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Parciales', // id_menu = 73
                'mnu_link'      => 'docentes/informe_parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 64,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Anuales', // id_menu = 74
                'mnu_link'      => 'docentes/informe_anual',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 64,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Quimestrales', // id_menu = 75
                'mnu_link'      => 'docentes/reporte_quimestral',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 65,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Anuales', // id_menu = 76
                'mnu_link'      => 'docentes/reporte_anual',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 65,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Por Parcial', // id_menu = 77
                'mnu_link'      => 'docentes/listas_parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 66,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Por Quimestre', // id_menu = 78
                'mnu_link'      => 'docentes/listas_quimestrales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 66,
                'mnu_publicado' => 1
			],
		];

		$builder = $this->db->table('sw_menu');
		$builder->insertBatch($menus);

        $menus_perfiles = [
            [
                'id_perfil' => 4,
                'id_menu' => 62
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 63
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 64
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 65
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 66
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 67
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 68
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 69
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 70
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 71
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 72
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 73
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 74
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 75
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 77
            ],
            [
                'id_perfil' => 4,
                'id_menu' => 78
            ],
        ];

        $builder = $this->db->table('sw_menu_perfil');
		$builder->insertBatch($menus_perfiles);
	}
}
