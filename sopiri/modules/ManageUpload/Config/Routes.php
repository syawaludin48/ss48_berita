<?php


$routes->group('/', ['namespace' => 'Modules\ManageUpload\Controllers'], function($routes){

    // slide
    $routes->get('/manage-upload-list', 'DataUpload::upload_list');


});
