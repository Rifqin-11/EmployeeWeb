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
$routes->get('/Settings', 'Settings::index');
$routes->get('/RoomSettings', 'Settings::RoomSettings', ['filter' => 'settingaccess']);
$routes->get('/EmployeeSettings', 'Settings::EmployeeSettings', ['filter' => 'settingaccess']);
$routes->post('/Settings/updateProfile', 'Settings::updateProfile');

$routes->group('settings',['filter' => 'settingaccess'], static function($routes){
    $routes->get('rooms', 'Settings::RoomSettings');
    $routes->post('rooms/add', 'Settings::addRoom');
    $routes->post('rooms/edit', 'Settings::editRoom');
    $routes->get('rooms/delete/(:num)', 'Settings::deleteRoom/$1');
    
    $routes->get('employees', 'Settings::EmployeeSettings');
    $routes->post('employees/add', 'Settings::addEmployee');
    $routes->post('employees/edit', 'Settings::editEmployee');
    $routes->get('employees/delete/(:num)', 'Settings::deleteEmployee/$1');
});

$routes->get('documentations/(:num)/(:any)', 'InfoData::viewImage/$1/$2');
