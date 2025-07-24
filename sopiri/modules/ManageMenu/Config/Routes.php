<?php 


$routes->group('/', ['namespace' => 'Modules\ManageMenu\Controllers'], function($routes){

    // menu
    $routes->get('/manage-menu', 'DataMenu::menu',['filter' => 'permission:manage-menu']);
    $routes->post('/manage-menu-save', 'DataMenu::menu_save',['filter' => 'permission:manage-menu']);
    $routes->post('/manage-menu-update', 'DataMenu::menu_update',['filter' => 'permission:manage-menu']);
    $routes->post('/manage-menu-delete', 'DataMenu::menu_delete',['filter' => 'permission:manage-menu']);

    
    // sub menu
    $routes->get('/manage-sub-menu', 'DataSubMenu::sub_menu',['filter' => 'permission:manage-sub-menu']);
    $routes->post('/manage-sub-menu-save', 'DataSubMenu::sub_menu_save',['filter' => 'permission:manage-sub-menu']);
    $routes->post('/manage-sub-menu-update', 'DataSubMenu::sub_menu_update',['filter' => 'permission:manage-sub-menu']);
    $routes->post('/manage-sub-menu-delete', 'DataSubMenu::sub_menu_delete',['filter' => 'permission:manage-sub-menu']);

    // sub sub menu
    $routes->get('/manage-menu-group', 'DataGroupMenu::group_menu',['filter' => 'permission:manage-menu-group']);
    $routes->post('/manage-menu-group-save', 'DataGroupMenu::group_menu_save',['filter' => 'permission:manage-menu-group']);
    $routes->post('/manage-menu-group-update', 'DataGroupMenu::group_menu_update',['filter' => 'permission:manage-menu-group']);
    $routes->post('/manage-menu-group-delete', 'DataGroupMenu::group_menu_delete',['filter' => 'permission:manage-menu-group']);

});
