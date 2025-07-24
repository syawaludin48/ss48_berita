<?php 

//$routes->get('/homee', 'Modules\FrontEndHome\Controllers\Home::index');

$routes->group('/', ['namespace' => 'Modules\ManageContentFront\Controllers'], function($routes){
    $routes->get('/content/(:any)', 'Content::index/$1');
    $routes->get('/spmi/(:any)', 'Content::index/$1');
});
