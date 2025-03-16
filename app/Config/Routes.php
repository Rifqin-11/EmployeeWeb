<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  Login
$routes->group('/' , ['filter' => 'haslogin'] ,static function ($routes){
    $routes->get('', 'LoginController::index');
    $routes->post('auth', 'LoginController::auth');
});

// Home
$routes->get('Home', 'Home::index');
$routes->get('Home/notification', 'Home::notificationmodal');
// History
$routes->get('History', 'History::index');
// Logout
$routes->get('/logout', 'LoginController::logout');

// Info Data
$routes->group('infodata', static function($routes){
    $routes->get('(:num)', 'InfoData::index/$1', ['filter' => 'guestaccess']);
    $routes->post('getrooms', 'InfoData::getrooms');
    $routes->put('edit', 'InfoData::edit');
    $routes->delete('deleteImage/(:num)', 'InfoData::deleteImage/$1');
});

// Settings
$routes->get('/Settings/Profile', 'Settings::index');
$routes->post('/Settings/updateProfile', 'Settings::updateProfile');

$routes->group('Settings',['filter' => 'settingaccess'], static function($routes){
    $routes->get('Rooms', 'Settings::RoomSettings');
    $routes->post('Rooms/add', 'Settings::addRoom');
    $routes->post('Rooms/edit', 'Settings::editRoom');
    $routes->get('Rooms/delete/(:num)', 'Settings::deleteRoom/$1');
    
    $routes->get('Employees', 'Settings::EmployeeSettings');
    $routes->post('Employees/add', 'Settings::addEmployee');
    $routes->post('Employees/edit', 'Settings::editEmployee');
    $routes->get('Employees/delete/(:num)', 'Settings::deleteEmployee/$1');
});

$routes->get('documentations/(:num)/(:any)', 'InfoData::viewImage/$1/$2');
