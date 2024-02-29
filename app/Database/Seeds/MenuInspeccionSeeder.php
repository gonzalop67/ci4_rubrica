<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Admin\MenusModel;
use App\Models\Admin\MenusPerfilesModel;

class MenuInspeccionSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
            [
				'mnu_texto'     => 'Comportamiento', // id_menu = 92
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Horarios', // id_menu = 93
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Definiciones', // id_menu = 94
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Consultas', // id_menu = 95
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Parciales', // id_menu = 96
                'mnu_link'      => 'inspeccion/parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 92,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Sub Periodo', // id_menu = 97
                'mnu_link'      => 'inspeccion/quimestrales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 92,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Periodo', // id_menu = 98
                'mnu_link'      => 'inspeccion/anuales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 92,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Leccionario', // id_menu = 99
                'mnu_link'      => 'inspeccion/leccionario',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 93,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'De Docentes', // id_menu = 100
                'mnu_link'      => 'inspeccion/horario_docentes',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 93,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Valor del mes', // id_menu = 101
                'mnu_link'      => 'inspeccion/valor_del_mes',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 94,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Feriados', // id_menu = 102
                'mnu_link'      => 'inspeccion/feriados',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 94,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Lista de Docentes', // id_menu = 103
                'mnu_link'      => 'inspeccion/lista_docentes',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 95,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Horarios de Clase', // id_menu = 104
                'mnu_link'      => 'inspeccion/horario_clases',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 95,
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
                'id_perfil' => 5
            ]);
        }

	}
}
