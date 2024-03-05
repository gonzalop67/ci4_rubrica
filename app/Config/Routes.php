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
    $routes->post('perfiles/eliminar', 'Perfiles::delete', ['as' => 'perfiles_delete']);
    //RUTAS PARA MENUS
	$routes->get('menus', 'Menus::index', ['as' => 'menus']);
    $routes->post('menus/dataMenus', 'Menus::dataMenus', ['as' => 'menus_data']);
    $routes->get('menus/formAgregar', 'Menus::formAgregar', ['as' => 'menus_form_crear']);
    $routes->post('menus/guardar', 'Menus::store', ['as' => 'menus_store']);
    $routes->post('menus/guardarOrden', 'Menus::guardarOrden', ['as' => 'menus_guardar_orden']);
    $routes->post('menus/editar', 'Menus::edit', ['as' => 'menus_edit']);
    $routes->post('menus/actualizar', 'Menus::update', ['as' => 'menus_update']);
    $routes->post('menus/eliminar', 'Menus::delete', ['as' => 'menus_delete']);
});