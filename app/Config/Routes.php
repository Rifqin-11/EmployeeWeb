<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->put('infoData/edit', 'InfoData::edit');

$routes->group('/' , ['filter' => 'haslogin'] ,static function ($routes){
    $routes->get('', 'LoginController::index');
    $routes->post('auth', 'LoginController::auth');
});

$routes->get('Home', 'Home::index');
$routes->get('Home/notification', 'Home::notificationmodal');
$routes->get('History', 'History::index');

$routes->get('/logout', 'LoginController::logout');

$routes->get('/Settings', 'Settings::index');
$routes->get('/RoomSettings', 'Settings::RoomSettings');
$routes->get('/EmployeeSettings', 'Settings::EmployeeSettings');

$routes->post('/Settings/updateProfile', 'Settings::updateProfile');

$routes->get('/settings/rooms', 'Settings::RoomSettings');
$routes->post('/settings/rooms/add', 'Settings::addRoom');
$routes->post('/settings/rooms/edit', 'Settings::editRoom');
$routes->get('/settings/rooms/delete/(:num)', 'Settings::deleteRoom/$1');

$routes->get('/settings/employees', 'Settings::EmployeeSettings');
$routes->post('/settings/employees/add', 'Settings::addEmployee');
$routes->post('/settings/employees/edit', 'Settings::editEmployee');
$routes->get('/settings/employees/delete/(:num)', 'Settings::deleteEmployee/$1');


$routes->group('infodata', static function($routes){
    $routes->get('(:num)', 'InfoData::index/$1', ['filter' => 'guestaccess']);
    $routes->post('getrooms', 'InfoData::getrooms');
    $routes->put('edit', 'InfoData::edit');
});

$routes->get('documentations/(:num)/(:any)', 'InfoData::viewImage/$1/$2');
$routes->delete('infodata/deleteImage/(:num)', 'InfoData::deleteImage/$1');


// $routes->post('upload/process', 'InfoData::uploadProcess');