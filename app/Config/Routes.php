<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth\Login::index', ['as' => 'login']);

$routes->group('auth', ['namespace' => 'App\Controllers\Auth'], static function ($routes) {

    $routes->group('', static function ($routes) {
        $routes->post('check', 'Login::signin', ['as' => 'signin']);
        $routes->get('logout', 'Login::signout', ['as' => 'signout']);
        $routes->get('dashboard', 'Login::dashboard', ['as' => 'dashboard']);
    });

});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    //RUTAS PARA MODALIDADES
    $routes->get('modalidades', 'Modalidad::index', ['as' => 'modalidades']);
    $routes->get('modalidades/dataModalidades', 'Modalidad::dataModalidades', ['as' => 'modalidades_data']);
    $routes->get('modalidades/create', 'Modalidad::create', ['as' => 'modalidades_create']);
    $routes->post('modalidades/guardar', 'Modalidad::store', ['as' => 'modalidades_store']);
    $routes->get('modalidades/editar/(:any)', 'Modalidad::edit/$1', ['as' => 'modalidades_edit']);
    $routes->post('modalidades/actualizar', 'Modalidad::update', ['as' => 'modalidades_update']);
    $routes->post('modalidades/eliminar', 'Modalidad::delete', ['as' => 'modalidades_delete']);
    $routes->post('modalidades/saveNewPositions', 'Modalidad::saveNewPositions', ['as' => 'modalidades_saveNewPositions']);
    //RUTAS PARA PERIODOS LECTIVOS
	$routes->get('periodos_lectivos', 'Periodos_lectivos::index', ['as' => 'periodos_lectivos']);
    $routes->get('periodos_lectivos/create', 'Periodos_lectivos::create', ['as' => 'periodos_lectivos_create']);
    $routes->post('periodos_lectivos/guardar', 'Periodos_lectivos::store', ['as' => 'periodos_lectivos_store']);
    $routes->get('periodos_lectivos/editar/(:any)', 'Periodos_lectivos::edit/$1', ['as' => 'periodos_lectivos_edit']);
    $routes->post('periodos_lectivos/actualizar', 'Periodos_lectivos::update', ['as' => 'periodos_lectivos_update']);
    //RUTAS PARA PERFILES
	$routes->get('perfiles', 'Perfiles::index', ['as' => 'perfiles']);
    $routes->get('perfiles/dataPerfiles', 'Perfiles::dataPerfiles', ['as' => 'perfiles_data']);
    $routes->get('perfiles/create', 'Perfiles::create', ['as' => 'perfiles_create']);
    $routes->post('perfiles/guardar', 'Perfiles::store', ['as' => 'perfiles_store']);
    $routes->get('perfiles/editar/(:any)', 'Perfiles::edit/$1', ['as' => 'perfiles_edit']);
    $routes->post('perfiles/actualizar', 'Perfiles::update', ['as' => 'perfiles_update']);
    $routes->post('perfiles/eliminar/(:any)', 'Perfiles::delete/$1', ['as' => 'perfiles_delete']);
    //RUTAS PARA MENUS
	$routes->get('menus', 'Menus::index', ['as' => 'menus']);
    $routes->post('menus/dataMenus', 'Menus::dataMenus', ['as' => 'menus_data']);
    $routes->get('menus/formAgregar', 'Menus::formAgregar', ['as' => 'menus_form_crear']);
    $routes->post('menus/guardar', 'Menus::store', ['as' => 'menus_store']);
    $routes->post('menus/guardarOrden', 'Menus::guardarOrden', ['as' => 'menus_guardar_orden']);
    $routes->post('menus/editar', 'Menus::edit', ['as' => 'menus_edit']);
    $routes->post('menus/actualizar', 'Menus::update', ['as' => 'menus_update']);
    $routes->post('menus/eliminar', 'Menus::delete', ['as' => 'menus_delete']);
    //RUTAS PARA USUARIOS
	$routes->get('usuarios', 'Usuarios::index', ['as' => 'usuarios']);
    $routes->get('usuarios/dataUsuarios', 'Usuarios::dataUsuarios', ['as' => 'usuarios_data']);
    $routes->get('usuarios/create', 'Usuarios::create', ['as' => 'usuarios_create']);
    $routes->post('usuarios/guardar', 'Usuarios::store', ['as' => 'usuarios_store']);
    $routes->get('usuarios/editar/(:any)', 'Usuarios::edit/$1', ['as' => 'usuarios_edit']);
    $routes->post('usuarios/actualizar', 'Usuarios::update', ['as' => 'usuarios_update']);
    //RUTAS PARA NIVELES DE EDUCACION
	$routes->get('niveles_educacion', 'Niveles_educacion::index', ['as' => 'niveles_educacion']);
    $routes->get('niveles_educacion/dataNivelesEducacion', 'Niveles_educacion::dataNivelesEducacion', ['as' => 'niveles_educacion_data']);
    $routes->get('niveles_educacion/create', 'Niveles_educacion::create', ['as' => 'niveles_educacion_create']);
    $routes->post('niveles_educacion/guardar', 'Niveles_educacion::store', ['as' => 'niveles_educacion_store']);
    $routes->get('niveles_educacion/editar/(:any)', 'Niveles_educacion::edit/$1', ['as' => 'niveles_educacion_edit']);
    $routes->post('niveles_educacion/actualizar', 'Niveles_educacion::update', ['as' => 'niveles_educacion_update']);
    $routes->post('niveles_educacion/eliminar', 'Niveles_educacion::delete', ['as' => 'niveles_educacion_delete']);
    $routes->post('niveles_educacion/saveNewPositions', 'Niveles_educacion::saveNewPositions', ['as' => 'niveles_educacion_saveNewPositions']);
    //RUTAS PARA ESPECIALIDADES
    $routes->get('especialidades', 'Especialidades::index', ['as' => 'especialidades']);
    $routes->get('especialidades/dataEspecialidades', 'Especialidades::dataEspecialidades', ['as' => 'especialidades_data']);
    $routes->get('especialidades/create', 'Especialidades::create', ['as' => 'especialidades_create']);
    $routes->post('especialidades/guardar', 'Especialidades::store', ['as' => 'especialidades_store']);
    $routes->get('especialidades/editar/(:any)', 'Especialidades::edit/$1', ['as' => 'especialidades_edit']);
    $routes->post('especialidades/actualizar', 'Especialidades::update', ['as' => 'especialidades_update']);
    $routes->post('especialidades/eliminar', 'Especialidades::delete', ['as' => 'especialidades_delete']);
    $routes->post('especialidades/saveNewPositions', 'Especialidades::saveNewPositions', ['as' => 'especialidades_saveNewPositions']);
    //RUTAS PARA CURSOS
    $routes->get('cursos', 'Cursos::index', ['as' => 'cursos']);
    $routes->get('cursos/dataEspecialidades', 'Cursos::dataCursos', ['as' => 'cursos_data']);
    $routes->get('cursos/create', 'Cursos::create', ['as' => 'cursos_create']);
    $routes->post('cursos/guardar', 'Cursos::store', ['as' => 'cursos_store']);
    $routes->get('cursos/editar/(:any)', 'Cursos::edit/$1', ['as' => 'cursos_edit']);
    $routes->post('cursos/actualizar', 'Cursos::update', ['as' => 'cursos_update']);
    $routes->post('cursos/eliminar', 'Cursos::delete', ['as' => 'cursos_delete']);
    $routes->post('cursos/saveNewPositions', 'Cursos::saveNewPositions', ['as' => 'cursos_saveNewPositions']);
    //RUTAS PARA PARALELOS
    $routes->get('paralelos', 'Paralelos::index', ['as' => 'paralelos']);
    $routes->get('paralelos/dataParalelos', 'Paralelos::dataParalelos', ['as' => 'paralelos_data']);
    $routes->get('paralelos/create', 'Paralelos::create', ['as' => 'paralelos_create']);
    $routes->post('paralelos/guardar', 'Paralelos::store', ['as' => 'paralelos_store']);
    $routes->get('paralelos/editar/(:any)', 'Paralelos::edit/$1', ['as' => 'paralelos_edit']);
    $routes->post('paralelos/actualizar', 'Paralelos::update', ['as' => 'paralelos_update']);
    $routes->post('paralelos/eliminar', 'Paralelos::delete', ['as' => 'paralelos_delete']);
    $routes->post('paralelos/saveNewPositions', 'Paralelos::saveNewPositions', ['as' => 'paralelos_saveNewPositions']);
    //RUTAS PARA AREAS
    $routes->get('areas', 'Areas::index', ['as' => 'areas']);
    $routes->get('areas/dataAreas', 'Areas::dataAreas', ['as' => 'areas_data']);
    $routes->get('areas/create', 'Areas::create', ['as' => 'areas_create']);
    $routes->post('areas/guardar', 'Areas::store', ['as' => 'areas_store']);
    $routes->get('areas/editar/(:any)', 'Areas::edit/$1', ['as' => 'areas_edit']);
    $routes->post('areas/actualizar', 'Areas::update', ['as' => 'areas_update']);
    $routes->post('areas/eliminar/(:any)', 'Areas::delete/$1', ['as' => 'areas_delete']);
    //RUTAS PARA ASIGNATURAS
    $routes->get('asignaturas', 'Asignaturas::index', ['as' => 'asignaturas']);
    $routes->get('asignaturas/dataAsignaturas', 'Asignaturas::dataAsignaturas', ['as' => 'asignaturas_data']);
    $routes->get('asignaturas/create', 'Asignaturas::create', ['as' => 'asignaturas_create']);
    $routes->post('asignaturas/guardar', 'Asignaturas::store', ['as' => 'asignaturas_store']);
    $routes->get('asignaturas/editar/(:any)', 'Asignaturas::edit/$1', ['as' => 'asignaturas_edit']);
    $routes->post('asignaturas/actualizar', 'Asignaturas::update', ['as' => 'asignaturas_update']);
    $routes->post('asignaturas/eliminar/(:any)', 'Asignaturas::delete/$1', ['as' => 'asignaturas_delete']);
    //RUTAS PARA INSTITUCION
    $routes->get('institucion', 'Institucion::index', ['as' => 'institucion']);
    $routes->post('institucion/actualizar', 'Institucion::update', ['as' => 'institucion_update']);
    $routes->post('institucion/actualizar_estado_copiar_y_pegar', 'Institucion::actualizar_estado_copiar_y_pegar', ['as' => 'institucion_actualizar_estado_copiar_y_pegar']);
    //RUTAS PARA PERIODOS DE EVALUACION
	$routes->get('periodos_evaluacion', 'Periodos_evaluacion::index', ['as' => 'periodos_evaluacion']);
    $routes->get('periodos_evaluacion/create', 'Periodos_evaluacion::create', ['as' => 'periodos_evaluacion_create']);
    $routes->post('periodos_evaluacion/guardar', 'Periodos_evaluacion::store', ['as' => 'periodos_evaluacion_store']);
    $routes->get('periodos_evaluacion/dataPeriodosEvaluacion', 'Periodos_evaluacion::dataPeriodosEvaluacion', ['as' => 'periodos_evaluacion_data']);
    $routes->get('periodos_evaluacion/editar/(:any)', 'Periodos_evaluacion::edit/$1', ['as' => 'periodos_evaluacion_edit']);
    $routes->post('periodos_evaluacion/actualizar', 'Periodos_evaluacion::update', ['as' => 'periodos_evaluacion_update']);
    $routes->post('periodos_evaluacion/saveNewPositions', 'Periodos_evaluacion::saveNewPositions', ['as' => 'periodos_evaluacion_saveNewPositions']);
    $routes->post('periodos_evaluacion/eliminar/(:any)', 'Periodos_evaluacion::delete/$1', ['as' => 'periodos_evaluacion_delete']);
    //RUTAS PARA APORTES DE EVALUACION
	$routes->get('aportes_evaluacion', 'Aportes_evaluacion::index', ['as' => 'aportes_evaluacion']);
    $routes->post('aportes_evaluacion/dataAportesEvaluacion', 'Aportes_evaluacion::dataAportesEvaluacion', ['as' => 'aportes_evaluacion_data']);
    //aportes_evaluacion_form_crear
    $routes->get('aportes_evaluacion/formAgregar', 'Aportes_evaluacion::formAgregar', ['as' => 'aportes_evaluacion_form_crear']);
});