<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('login', 'Auth::login');
$routes->get('auth/google', 'Auth::google');
$routes->get('auth/google/callback', 'Auth::callback');
$routes->get('logout', 'Auth::logout');


$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('perfil', 'Perfil::index');
    $routes->get('dashboard', 'Profesor\Profesor::index');

    $routes->get('asistencia/pasar/(:num)', 'Profesor\Asistencia::pasar/$1');
});
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\Admin::index');

    // USUARIOS
    $routes->get('usuarios', 'Admin\User::index');
    $routes->get('usuarios/ver/(:num)', 'Admin\User::show/$1');
    $routes->get('usuarios/crear', 'Admin\User::new');

    // ACADEMIAS
    $routes->get('academias', 'Admin\Academia::index');
    $routes->post('academias/guardar', 'Admin\Academia::guardar');
    $routes->get('academias/asignar/(:num)', 'Admin\Academia::asignar/$1');
    // $routes->view('academias', 'admin/academias/index');

    // CONFIGURACION
    $routes->get('config/tema', 'Admin\Config\ThemeEditor::index');
});
