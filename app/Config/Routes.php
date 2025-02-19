<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('/' , ['filter' => 'haslogin'] ,static function ($routes){
    $routes->get('', 'LoginController::index');
    $routes->post('auth', 'LoginController::auth');
});
$routes->get('Home', 'Home::index');
$routes->get('Home/notification', 'Home::notificationmodal');
$routes->get('History', 'History::index');

$routes->get('/logout', 'LoginController::logout');
$routes->get('/Settings', 'Settings::index');

$routes->group('infodata', static function($routes){
    $routes->get('(:num)', 'InfoData::index/$1', ['filter' => 'guestaccess']);
    $routes->post('getrooms', 'InfoData::getrooms');
    $routes->put('edit', 'InfoData::edit');
});

// $routes->post('upload/process', 'InfoData::uploadProcess');
