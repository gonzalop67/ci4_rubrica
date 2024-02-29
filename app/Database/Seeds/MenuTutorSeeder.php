<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Admin\MenusModel;
use App\Models\Admin\MenusPerfilesModel;

class MenuTutorSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
            [
				'mnu_texto'     => 'Reportes', // id_menu = 79
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Comportamiento', // id_menu = 80
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Consultas', // id_menu = 81
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Asistencia', // id_menu = 82
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Parciales', // id_menu = 83
                'mnu_link'      => 'tutores/parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 79,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Sub Periodo', // id_menu = 84
                'mnu_link'      => 'tutores/quimestrales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 79,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Periodo', // id_menu = 85
                'mnu_link'      => 'tutores/anuales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 79,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Supletorios', // id_menu = 86
                'mnu_link'      => 'tutores/supletorios',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 79,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Parciales', // id_menu = 87
                'mnu_link'      => 'tutores/comp_parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 80,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Sub Periodos', // id_menu = 88
                'mnu_link'      => 'tutores/comp_sub_periodos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 80,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Lista de Docentes', // id_menu = 89
                'mnu_link'      => 'tutores/lista_docentes',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 81,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Horario de Clases', // id_menu = 90
                'mnu_link'      => 'tutores/horario_clases',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 81,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Justificar Faltas', // id_menu = 91
                'mnu_link'      => 'tutores/justificar_faltas',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 82,
                'mnu_publicado' => 1
			],
		];

        $menuModel = new MenusModel();
        $menuPerfilModel = new MenusPerfilesModel();

        foreach ($menus as $menu) {
            $menuModel->save([
                'mnu_texto'     => $menu['mnu_texto'],
                'mnu_link'      => $menu['mnu_link'],
                'mnu_nivel'     => $menu['mnu_nivel'],
                'mnu_orden'     => $menu['mnu_orden'],
                'mnu_padre'     => $menu['mnu_padre'],
                'mnu_publicado' => $menu['mnu_publicado']
            ]);
            $id_menu = $menuModel->getInsertID();
            $menuPerfilModel->save([
                'id_menu' => $id_menu,
                'id_perfil' => 8
            ]);
        }

	}
}
