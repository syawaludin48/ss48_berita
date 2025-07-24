<?php 

//$routes->get('/homee', 'Modules\FrontEndHome\Controllers\Home::index');

$routes->group('/', ['namespace' => 'Modules\ManageLayout\Controllers'], function($routes){
    $routes->get('/admin', 'Layout::admin');
    $routes->get('/manage-home', 'Layout::index');
    $routes->get('/manage-home/index', 'Layout::index');
});
