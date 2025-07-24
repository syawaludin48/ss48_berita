<?php


$routes->group('/', ['namespace' => 'Modules\Login\Controllers'], function($routes){
    $routes->get('/login', 'Login::index');
    $routes->get('/register', 'Login::register');
    $routes->get('/forgot', 'Login::forgot');
    $routes->get('/reset-password', 'Login::reset');
    
});