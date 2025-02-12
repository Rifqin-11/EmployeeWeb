<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
$routes->get('/Home', 'Home::index');
$routes->get('/History', 'History::index');
$routes->get('infodata', 'InfoData::index');
$routes->put('infoData/edit', 'InfoData::edit');
$routes->get('infodata/(:num)', 'InfoData::index/$1');
$routes->post('/auth', 'LoginController::auth');
$routes->get('/logout', 'LoginController::logout');
