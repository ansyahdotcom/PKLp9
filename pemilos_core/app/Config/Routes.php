<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Route Landing Page
// $routes->get('/(:any)', 'Login::index');

// Route Dashboard Userrr
$routes->get('/user', 'User::index');
$routes->post('/submit', 'Landingpage::submit');
$routes->get('/', 'Landingpage::index');
$routes->get('/login', 'Login::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/user/delete/(:num)', 'User::delete/$1');

// Route Logout
$routes->get('/logout', 'Login::logout');

// Route Admin
$routes->get('/admin', 'Login::admin');
$routes->get('/reset', 'Dashboard::resett');
$routes->get('/admin', 'Login::admin');
$routes->get('/forgot_password', 'Login::forgot_password');
$routes->get('/laporan', 'Dashboard::laporan');

// Route Kelas (Admin)
$routes->get('/kelas/delete/(:any)', 'Kelas::index/$1');
$routes->get('/kelas/addKelas', 'Kelas::addKelas');
$routes->get('/kelas/detailKelas/(:segment)', 'Kelas::detailKelas/$1');
$routes->get('/kelas/editKelas/(:segment)', 'Kelas::editKelas/$1');
$routes->delete('/kelas/(:num)', 'Kelas::delete/$1');

// Route Kandidat (Admin)
$routes->get('/kandidat/editKandidat/(:segment)', 'Kandidat::editKandidat/$1');
$routes->get('/periode/editPeriode/(:segment)', 'Periode::editPeriode/$1');
$routes->delete('/kandidat/(:num)', 'Kandidat::delete/$1');
$routes->delete('/periode/(:num)', 'Periode::delete/$1');
$routes->post('/submit', 'Landingpage::submit');

// Route Periode
$routes->post('/periode/active/(:num)', 'Periode::active/$1');
$routes->post('/periode/nonactive/(:num)', 'Periode::nonactive/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
