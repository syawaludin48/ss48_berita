<?php 


$routes->group('/', ['namespace' => 'Modules\ManageGaleri\Controllers'], function($routes){

    // slide
    $routes->get('/manage-galeri-master', 'DataGaleriMaster::galeri',['filter' => 'permission:manage-galeri-master']);
    $routes->get('/manage-galeri-master/tambah', 'DataGaleriMaster::galeri_tambah',['filter' => 'permission:manage-galeri-master,manage-tambah-data']);
    $routes->post('/manage-galeri-master-save', 'DataGaleriMaster::galeri_save',['filter' => 'permission:manage-galeri-master,manage-tambah-data']);
    $routes->get('/manage-galeri-master/edit/(:any)', 'DataGaleriMaster::galeri_edit/$1',['filter' => 'permission:manage-galeri-master,manage-edit-data']);
    $routes->post('/manage-galeri-master-update', 'DataGaleriMaster::galeri_update',['filter' => 'permission:manage-galeri-master,manage-edit-data']);
    $routes->post('/manage-galeri-master-delete', 'DataGaleriMaster::galeri_delete',['filter' => 'permission:manage-galeri-master,manage-delete-data']);
    $routes->get('/manage-galeri-master/galeri/(:any)', 'DataGaleriMaster::galeri_sub/$1',['filter' => 'permission:manage-galeri-master,manage-edit-data']);
    $routes->post('/manage-galeri-master-save-galeri', 'DataGaleriMaster::galeri_save_save',['filter' => 'permission:manage-galeri-master,manage-tambah-data']);
    $routes->post('/manage-galeri-master-delete-galeri', 'DataGaleriMaster::galeri_delete_galeri',['filter' => 'permission:manage-galeri-master,manage-delete-data']);

    // Kategori 
    $routes->get('/manage-galeri-kategori', 'DataKategori::kategori_galeri',['filter' => 'permission:manage-galeri-kategori']);
    $routes->post('/manage-galeri-kategori-save', 'DataKategori::kategori_galeri_save',['filter' => 'permission:manage-galeri-kategori,manage-tambah-data']);
    $routes->post('/manage-galeri-kategori-update', 'DataKategori::kategori_galeri_update',['filter' => 'permission:manage-galeri-kategori,manage-edit-data']);
    $routes->post('/manage-galeri-kategori-delete', 'DataKategori::kategori_galeri_delete',['filter' => 'permission:manage-galeri-kategori,manage-delete-data']);


});
