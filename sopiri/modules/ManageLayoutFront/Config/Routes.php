<?php 

//$routes->get('/homee', 'Modules\FrontEndHome\Controllers\Home::index');

$routes->group('/', ['namespace' => 'Modules\ManageLayoutFront\Controllers'], function($routes){
    $routes->get('', 'Layout::index');
});
