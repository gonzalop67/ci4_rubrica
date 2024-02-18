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
    $routes->get('modalidades/create', 'Modalidad::create', ['as' => 'modalidades_create']);
    $routes->post('modalidades/guardar', 'Modalidad::store', ['as' => 'modalidades_store']);
    $routes->get('modalidades/editar/(:any)', 'Modalidad::edit/$1', ['as' => 'modalidades_edit']);
    $routes->post('modalidades/actualizar', 'Modalidad::update', ['as' => 'modalidades_update']);
    $routes->get('modalidades/eliminar', 'Modalidad::delete', ['as' => 'modalidades_delete']);
});