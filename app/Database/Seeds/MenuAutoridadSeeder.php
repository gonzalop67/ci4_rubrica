<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Admin\MenusModel;
use App\Models\Admin\MenusPerfilesModel;

class MenuAutoridadSeeder extends Seeder
{
	public function run()
	{	
		
        $menus = [
			[
				'mnu_texto'     => 'Definiciones', // id_menu = 27
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 1,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Horarios', // id_menu = 28
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 2,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Reportes', // id_menu = 29
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 3,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Consultas', // id_menu = 30
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 4,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Estadísticas', // id_menu = 31
                'mnu_link'      => '#',
                'mnu_nivel'     => 1,
                'mnu_orden'     => 5,
                'mnu_padre'     => 0,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Malla Curricular', // id_menu = 32
                'mnu_link'      => 'autoridad/mallas_curriculares',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 27,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Distributivo', // id_menu = 33
                'mnu_link'      => 'autoridad/distributivos',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 27,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Definir Días de la Semana', // id_menu = 34
                'mnu_link'      => 'autoridad/dias_semana',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 28,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Definir Horas Clase', // id_menu = 35
                'mnu_link'      => 'autoridad/horas_clase',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 28,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Asociar Dia-Hora', // id_menu = 36
                'mnu_link'      => 'autoridad/horas_dia',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 28,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Definir Horario Semanal', // id_menu = 37
                'mnu_link'      => 'autoridad/horarios',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 4,
                'mnu_padre'     => 28,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Definir Inasistencias', // id_menu = 38
                'mnu_link'      => 'autoridad/inasistencias',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 5,
                'mnu_padre'     => 28,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Parciales', // id_menu = 39
                'mnu_link'      => 'autoridad/reporte_parciales',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 29,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Quimestrales', // id_menu = 40
                'mnu_link'      => 'autoridad/reporte_quimestral',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 29,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Anuales', // id_menu = 41
                'mnu_link'      => 'autoridad/reporte_anual',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 3,
                'mnu_padre'     => 29,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Lista de docentes', // id_menu = 42
                'mnu_link'      => 'autoridad/lista_docentes',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 30,
                'mnu_publicado' => 1
			],
            [
				'mnu_texto'     => 'Horarios de clase', // id_menu = 43
                'mnu_link'      => 'autoridad/horario_clases',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 2,
                'mnu_padre'     => 30,
                'mnu_publicado' => 1
			],
			[
				'mnu_texto'     => 'Aprobados por Paralelo', // id_menu = 44
                'mnu_link'      => 'autoridad/aprobados_paralelo',
                'mnu_nivel'     => 2,
                'mnu_orden'     => 1,
                'mnu_padre'     => 31,
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
                'id_perfil' => 2
            ]);
        }

	}
}
