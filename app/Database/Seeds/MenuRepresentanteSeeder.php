<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Admin\MenusModel;
use App\Models\Admin\MenusPerfilesModel;

class MenuRepresentanteSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
            [
				'mnu_texto'     => 'Reportes', // id_menu = 105
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Parciales', // id_menu = 110
                'mnu_link'      => 'dece/parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 105,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Sub Periodos', // id_menu = 111
                'mnu_link'      => 'dece/sub_periodos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 105,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Periodos', // id_menu = 112
                'mnu_link'      => 'dece/periodos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 105,
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
                'id_perfil' => 6
            ]);
        }

	}
}
