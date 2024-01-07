<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuSecretariaSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
            [
				'mnu_texto'     => 'Matriculación', // id_menu = 45
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Libretación', // id_menu = 46
                'mnu_link'      => 'secretaria/libretacion',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Reporte', // id_menu = 47
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'A Excel', // id_menu = 48
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Promoción', // id_menu = 49
                'mnu_link'      => 'secretaria/promocion',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 5,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos', // id_menu = 50
                'mnu_link'      => 'secretaria/matriculacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 45,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Nómina de Matriculados', // id_menu = 51
                'mnu_link'      => 'secretaria/nomina_matriculados',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Por Asignatura', // id_menu = 52
                'mnu_link'      => 'secretaria/por_asignatura',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Parciales', // id_menu = 53
                'mnu_link'      => 'secretaria/reporte_parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Quimestral', // id_menu = 54
                'mnu_link'      => 'secretaria/reporte_quimestral',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Anual', // id_menu = 55
                'mnu_link'      => 'secretaria/reporte_anual',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Supletorios', // id_menu = 56
                'mnu_link'      => 'secretaria/reporte_supletorios',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 6,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Remediales', // id_menu = 57
                'mnu_link'      => 'secretaria/reporte_remediales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 7,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Exámenes de Gracia', // id_menu = 58
                'mnu_link'      => 'secretaria/reporte_examenes_gracia',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 8,
                'mnu_padre'     => 47,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Padrón Electoral', // id_menu = 59
                'mnu_link'      => 'secretaria/padron_electoral',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 48,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Cuadro Final', // id_menu = 60
                'mnu_link'      => 'secretaria/cuadro_final',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 48,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Cuadro Remediales', // id_menu = 61
                'mnu_link'      => 'secretaria/cuadro_remediales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 48,
                'mnu_publicado' => 1
			],
		];

		$builder = $this->db->table('sw_menu');
		$builder->insertBatch($menus);

        $menus_perfiles = [
            [
                'id_perfil' => 7,
                'id_menu' => 45
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 46
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 47
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 48
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 49
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 50
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 51
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 52
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 53
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 54
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 55
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 56
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 57
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 58
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 59
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 60
            ],
            [
                'id_perfil' => 7,
                'id_menu' => 61
            ],
        ];

        $builder = $this->db->table('sw_menu_perfil');
		$builder->insertBatch($menus_perfiles);
	}
}
