<?php 

$routes->group('/', ['namespace' => 'Modules\ManageContact\Controllers'], function($routes){

    // slide
    $routes->get('/manage-contact-website', 'DataContact::contact_edit',['filter' => 'permission:manage-contact-website,manage-edit-data']);
    $routes->post('/manage-contact-website-update', 'DataContact::contact_update',['filter' => 'permission:manage-contact-website,manage-edit-data']);

});
