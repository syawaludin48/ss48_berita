<?php 


$routes->group('/', ['namespace' => 'Modules\ManageMenuWebsite\Controllers'], function($routes){

    // menu
    $routes->get('/manage-menu-website', 'DataMenu::menu',['filter' => 'permission:manage-menu-website']);
    $routes->post('/manage-menu-website-save', 'DataMenu::menu_save',['filter' => 'permission:manage-menu-website,manage-tambah-data']);
    $routes->post('/manage-menu-website-update', 'DataMenu::menu_update',['filter' => 'permission:manage-menu-website,manage-edit-data']);
    $routes->post('/manage-menu-website-delete', 'DataMenu::menu_delete',['filter' => 'permission:manage-menu-website,manage-delete-data']);

    
    // sub menu
    $routes->get('/manage-sub-menu-website', 'DataSubMenu::sub_menu',['filter' => 'permission:manage-sub-menu-website']);
    $routes->post('/manage-sub-menu-website-save', 'DataSubMenu::sub_menu_save',['filter' => 'permission:manage-sub-menu-website,manage-tambah-data']);
    $routes->post('/manage-sub-menu-website-update', 'DataSubMenu::sub_menu_update',['filter' => 'permission:manage-sub-menu-website,manage-edit-data']);
    $routes->post('/manage-sub-menu-website-delete', 'DataSubMenu::sub_menu_delete',['filter' => 'permission:manage-sub-menu-website,manage-delete-data']);

    // sub sub menu
    $routes->get('/manage-sub-sub-menu-website', 'DataSubSubMenu::sub_sub_menu',['filter' => 'permission:manage-sub-sub-menu-website']);
    $routes->post('/manage-sub-sub-menu-website-save', 'DataSubSubMenu::sub_sub_menu_save',['filter' => 'permission:manage-sub-sub-menu-website,manage-tambah-data']);
    $routes->post('/manage-sub-sub-menu-website-update', 'DataSubSubMenu::sub_sub_menu_update',['filter' => 'permission:manage-sub-sub-menu-website,manage-edit-data']);
    $routes->post('/manage-sub-sub-menu-website-delete', 'DataSubSubMenu::sub_sub_menu_delete',['filter' => 'permission:manage-sub-sub-menu-website,manage-delete-data']);

});
