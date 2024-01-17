<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->post('/login', 'Home::login');
$routes->get('logout', 'Home::login');
$routes->get('datasiswa', 'Home::datasiswa');
$routes->get('/tambahdata', 'Home::tambahdata');
$routes->post('/simpanData', 'Home::simpanData');
$routes->get('/edit/(:num)', 'Home::edit/$1');
$routes->post('Home/update/(:num)', 'Home::update/$1');
$routes->post('/import', 'Home::import');
$routes->get('delete/(:num)', 'Home::delete/$1');
$routes->get('/proses', 'Home::proses');
$routes->get('/hitungMOORA', 'Home::hitungMOORA');
$routes->get('/hasil', 'Home::hasil');
$routes->get('/perhitungan', 'Home::index');
$routes->get('download', 'Home::download');
$routes->get('/generatePdf', 'Home::generatePdf'); 
$routes->get('/cleardata', 'Home::cleardata');
$routes->get('/clearhasil', 'Home::clearhasil');
$routes->get('/histori', 'Home::histori');
$routes->get('/kriteria', 'Home::kriteria');
$routes->post('simpankriteria', 'Home::simpankriteria');











