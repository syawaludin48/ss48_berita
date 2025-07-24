<?php

$routes->group('/', ['namespace' => 'Modules\ManageHargaFront\Controllers'], function($routes){
    $routes->get('list-paket', 'Harga::index');
});
