<?php

$routes->group('/', ['namespace' => 'Modules\ManageContactFront\Controllers'], function($routes){
    $routes->get('hubungi-kami', 'Contact::index');
});
