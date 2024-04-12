<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Admin\MenusModel;
use App\Models\Admin\MenusPerfilesModel;

class MenuAdministradorSeeder extends Seeder
{
	public function run()
	{	
        $menus = [
			[
				'mnu_texto'     => 'Administración', // id_menu = 1
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Definiciones', // id_menu = 2
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Especificaciones', // id_menu = 3
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Asociar', // id_menu = 4
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Cierres', // id_menu = 5
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 5,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Institución', // id_menu = 6
                'mnu_link'      => 'admin/institucion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Modalidades', // id_menu = 7
                'mnu_link'      => 'admin/modalidades',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Períodos Lectivos', // id_menu = 8
                'mnu_link'      => 'admin/periodos_lectivos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Perfiles', // id_menu = 9
                'mnu_link'      => 'admin/perfiles',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Menús', // id_menu = 10
                'mnu_link'      => 'admin/menus',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Usuarios', // id_menu = 11
                'mnu_link'      => 'admin/usuarios',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 6,
                'mnu_padre'     => 1,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Niveles de Educación', // id_menu = 12
                'mnu_link'      => 'admin/niveles_educacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Especialidades', // id_menu = 13
                'mnu_link'      => 'admin/especialidades',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Cursos', // id_menu = 14
                'mnu_link'      => 'admin/cursos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos', // id_menu = 15
                'mnu_link'      => 'admin/paralelos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Areas', // id_menu = 16
                'mnu_link'      => 'admin/areas',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Asignaturas', // id_menu = 17
                'mnu_link'      => 'admin/asignaturas',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 6,
                'mnu_padre'     => 2,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Períodos de Evaluación', // id_menu = 18
                'mnu_link'      => 'admin/periodos_evaluacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Aportes de Evaluación', // id_menu = 19
                'mnu_link'      => 'admin/aportes_evaluacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Insumos de Evaluación', // id_menu = 20
                'mnu_link'      => 'admin/insumos_evaluacion',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Escalas de Calificaciones', // id_menu = 21
                'mnu_link'      => 'admin/escalas_calificaciones',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 3,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Periodos Niveles', // id_menu = 22
                'mnu_link'      => 'admin/periodos_niveles',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Asignaturas Cursos', // id_menu = 23
                'mnu_link'      => 'admin/asignaturas_cursos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Curso Superior', // id_menu = 24
                'mnu_link'      => 'admin/curso_superior',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos Tutores', // id_menu = 25
                'mnu_link'      => 'admin/paralelos_tutores',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Paralelos Inspectores', // id_menu = 26
                'mnu_link'      => 'admin/paralelos_inspectores',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 4,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Periodos', // id_menu = 27
                'mnu_link'      => 'admin/cierre_periodos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 5,
                'mnu_publicado' => 1
			]
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
                'id_perfil' => 1
            ]);
        }
	}
}
