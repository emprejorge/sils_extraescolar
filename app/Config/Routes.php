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
    $routes->get('dashboard', 'Dashboard::index');
});
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\Admin::index');

    // USUARIOS
    $routes->get('usuarios', 'Admin\User::index');
    $routes->get('usuarios/ver/(:num)', 'Admin\User::show/$1');
    $routes->get('usuarios/crear', 'Admin\User::new');

    // CONFIGURACION
    $routes->get('config/tema', 'Admin\Config\ThemeEditor::index');
});
