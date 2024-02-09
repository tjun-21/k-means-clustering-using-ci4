<?php

use CodeIgniter\Router\RouteCollection;


$routes->setDefaultController('dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Dashboard::index', ['filter' => 'myFilter']);

$routes->get('/profil', 'Dashboard::profil', ['filter' => 'myFilter']);

$routes->get('/ubah_password', 'Dashboard::ubah_password', ['filter' => 'myFilter']);
// $routes->get('/update_password', 'Dashboard::update_password');

$routes->get('/login', 'Login::index', ['filter' => 'filLogin']);

$routes->get('/penjualan', 'Penjualan::index',  ['filter' => 'myFilter']);

$routes->get('/centroid', 'Centroid::index', ['filter' => 'myFilter']);
$routes->get('/centroid/ubah', 'Centroid::ubah', ['filter' => 'myFilter']);

$routes->get('/jenis', 'Jenis::index', ['filter' => 'myFilter']);
$routes->get('/jenis/create', 'Jenis::create');
$routes->get('/jenis/edit/(:segment)', 'Jenis::edit/$1');
$routes->get('/jenis/hapus/(:any)', 'Jenis::hapus/$1');

$routes->get('/satuan', 'Satuan::index', ['filter' => 'myFilter']);
$routes->get('/satuan/create', 'Satuan::create');
$routes->get('/satuan/edit/(:segment)', 'Satuan::edit/$1');
$routes->get('/satuan/hapus/(:any)', 'Satuan::hapus/$1');

// $routes->delete('/alumni/(:num)', 'Alumni::delete/$1');
// $routes->get('/alumni/(:any)', 'Alumni::detail/$1');
// $routes->get('/alumni/edit/(:any)', 'Alumni::edit/$1');
