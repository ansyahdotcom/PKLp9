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
$routes->get('/landing', 'Landing::index/$1');
$routes->get('/landing/pilih', 'Landing::pilih/$1');

// Route Dashboard User
$routes->get('/user', 'User::index');
$routes->post('/submit', 'Dashboard_user::submit');

// Route Profil (User)
$routes->get('/profile', 'Profile_user::index');

// Route Logout (User)
$routes->get('/logout', 'Login::logout');

// Route Dashboard Admin
$routes->get('/admin', 'Dashboard::index');

// Route Kelas (Admin)
$routes->get('/kelas/detailKelas/(:segment)', 'Kelas::detailKelas/$1');
$routes->get('/kelas/addKelas', 'Kelas::addKelas');
$routes->get('/kelas/editKelas/(:segment)', 'Kelas::editKelas/$1');
$routes->delete('/kelas/(:num)', 'Kelas::delete/$1');
$routes->get('/kelas/(:any)', 'Kelas::index/$1');

// Route Kandidat (Admin)
$routes->get('/kandidat/editKandidat/(:segment)', 'Kandidat::editKandidat/$1');
$routes->get('/periode/editPeriode/(:segment)', 'Periode::editPeriode/$1');
$routes->delete('/kandidat/(:num)', 'Kandidat::delete/$1');
$routes->delete('/periode/(:num)', 'Periode::delete/$1');
$routes->post('/submit', 'Dashboard_user::submit');

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
