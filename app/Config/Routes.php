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
 $routes->get('History', 'History::index');
 $routes->get('/Settings', 'Settings::index');
 
 $routes->get('/logout', 'LoginController::logout');
 
 $routes->get('infodata', 'InfoData::index');
 
 $routes->post('upload/process', 'InfoData::uploadProcess');
 
 if (session()->get('is_admin') == 0){
     $guestBookModel = new App\Models\GuestBooksModel();
     $guests_id = $guestBookModel->getIdGuests(session()->get('email'));
     foreach ($guests_id as $guest_id) {
         $routes->get('infodata/' . $guest_id, 'InfoData::index/'. $guest_id);
     }
 }  else {
     $routes->get('infodata/(:num)', 'InfoData::index/$1');
 }

