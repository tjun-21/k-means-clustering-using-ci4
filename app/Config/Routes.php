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
$routes->get('/', 'Dashboard::index');

$routes->get('/penjualan', 'Penjualan::index');

$routes->get('/jenis', 'Jenis::index');
$routes->get('/jenis/create', 'Jenis::create');
$routes->get('/jenis/edit/(:segment)', 'Jenis::edit/$1');
$routes->get('/jenis/hapus/(:any)', 'Jenis::hapus/$1');

$routes->get('/satuan', 'Satuan::index');
$routes->get('/satuan/create', 'Satuan::create');
$routes->get('/satuan/edit/(:segment)', 'Satuan::edit/$1');
$routes->get('/satuan/hapus/(:any)', 'Satuan::hapus/$1');

// $routes->delete('/alumni/(:num)', 'Alumni::delete/$1');
// $routes->get('/alumni/(:any)', 'Alumni::detail/$1');
// $routes->get('/alumni/edit/(:any)', 'Alumni::edit/$1');
