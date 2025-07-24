<?php 


$routes->group('/', ['namespace' => 'Modules\ManageContent\Controllers'], function($routes){

    // content
    $routes->get('/manage-content-website', 'DataContent::content',['filter' => 'permission:manage-content-website']);
    $routes->get('/manage-content-website/tambah', 'DataContent::content_tambah',['filter' => 'permission:manage-content-website,manage-tambah-data']);
    $routes->post('/manage-save-content-website', 'DataContent::content_save',['filter' => 'permission:manage-content-website,manage-tambah-data']);
    $routes->get('/manage-content-website/edit/(:any)', 'DataContent::content_edit/$1',['filter' => 'permission:manage-content-website,manage-edit-data']);
    $routes->post('/manage-update-content-website', 'DataContent::content_update',['filter' => 'permission:manage-content-website,manage-edit-data']);
    $routes->post('/manage-delete-content-website', 'DataContent::content_delete',['filter' => 'permission:manage-content-website,manage-delete-data']);
    // label
    $routes->get('/manage-content-kategori', 'DataKategori::kategori',['filter' => 'permission:manage-content-kategori']);
    $routes->post('/manage-content-kategori-save', 'DataKategori::kategori_save',['filter' => 'permission:manage-content-kategori,manage-tambah-data']);
    $routes->post('/manage-content-kategori-update', 'DataKategori::kategori_update',['filter' => 'permission:manage-content-kategori,manage-edit-data']);
    $routes->post('/manage-content-kategori-delete', 'DataKategori::kategori_delete',['filter' => 'permission:manage-content-kategori,manage-delete-data']);


});
