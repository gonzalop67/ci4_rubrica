<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuAdministradorSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
			[
				'mnu_texto'     => 'Administración',
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Definiciones',
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Especificaciones',
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Asociar',
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Cierres',
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 5,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Modalidades',
                'mnu_link'      => 'admin/modalidades',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Períodos Lectivos',
                'mnu_link'      => 'admin/periodos_lectivos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Perfiles',
                'mnu_link'      => 'admin/perfiles',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Menús',
                'mnu_link'      => 'admin/menus',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Usuarios',
                'mnu_link'      => 'admin/usuarios',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Niveles de Educación',
                'mnu_link'      => 'admin/tipos_educacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Especialidades',
                'mnu_link'      => 'admin/especialidades',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Cursos',
                'mnu_link'      => 'admin/cursos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos',
                'mnu_link'      => 'admin/paralelos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Areas',
                'mnu_link'      => 'admin/areas',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Asignaturas',
                'mnu_link'      => 'admin/asignaturas',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 6,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Institución',
                'mnu_link'      => 'admin/institucion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 7,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Períodos de Evaluación',
                'mnu_link'      => 'admin/periodos_evaluacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Aportes de Evaluación',
                'mnu_link'      => 'admin/aportes_evaluacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Insumos de Evaluación',
                'mnu_link'      => 'admin/rubricas_evaluacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Escalas de Calificaciones',
                'mnu_link'      => 'admin/escalas_calificaciones',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Asignaturas Cursos',
                'mnu_link'      => 'admin/asignaturas_cursos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Curso Superior',
                'mnu_link'      => 'admin/curso_superior',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos Tutores',
                'mnu_link'      => 'admin/paralelos_tutores',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos Inspectores',
                'mnu_link'      => 'admin/paralelos_inspectores',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Periodos',
                'mnu_link'      => 'admin/cierre_periodos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 5,
                'mnu_publicado' => 1
			]
		];

		$builder = $this->db->table('sw_menu');
		$builder->insertBatch($menus);

        $menus_perfiles = [
            [
                'id_perfil' => 1,
                'id_menu' => 1
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 2
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 3
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 4
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 5
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 6
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 7
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 8
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 9
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 10
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 11
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 12
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 13
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 14
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 15
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 16
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 17
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 18
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 19
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 20
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 21
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 22
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 23
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 24
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 25
            ],
            [
                'id_perfil' => 1,
                'id_menu' => 26
            ],
        ];

        $builder = $this->db->table('sw_menu_perfil');
		$builder->insertBatch($menus_perfiles);
	}
}
