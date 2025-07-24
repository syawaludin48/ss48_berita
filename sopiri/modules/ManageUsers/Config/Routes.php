<?php 


$routes->group('/', ['namespace' => 'Modules\ManageUsers\Controllers'], function($routes){

    // users
    $routes->get('/manage-users', 'DataUsers::index',['filter' => 'permission:manage-users']);
    $routes->get('/manage-users/index', 'DataUsers::index',['filter' => 'permission:manage-users']);
    $routes->get('/manage-users/tambah-data', 'DataUsers::tambah_users',['filter' => 'permission:manage-users']);
    $routes->get('/manage-users/edit-data/(:any)', 'DataUsers::edit_users/$1',['filter' => 'permission:manage-users']);
    $routes->get('/manage-users/profile/(:any)', 'DataUsers::profile/$1',['filter' => 'permission:manage-profile']);
    $routes->post('/manage-users-profile-edit', 'DataUsers::edit_profile',['filter' => 'permission:manage-profile']);
    $routes->post('/manage-delete-users', 'DataUsers::delete_users',['filter' => 'permission:manage-users']);
    $routes->post('/manage-save-users', 'DataUsers::save_users',['filter' => 'permission:manage-users']);
    $routes->post('/manage-update-users', 'DataUsers::update_users',['filter' => 'permission:manage-users']);
    $routes->post('/manage-users-profile-password', 'DataUsers::edit_password',['filter' => 'permission:manage-profile']);
    
    // users mahasiswa
    $routes->get('/mahasiswa-users-profile/(:any)', 'DataUsers::profile_mahasiswa/$1',['filter' => 'permission:mahasiswa-manage-profile']);
    $routes->post('/mahasiswa-users-profile-edit', 'DataUsers::edit_profile_mahasiswa',['filter' => 'permission:mahasiswa-manage-profile']);
    
    // groups
    $routes->get('/manage-groups', 'DataGroups::index',['filter' => 'permission:manage-groups']);
    $routes->get('/manage-groups/index', 'DataGroups::index',['filter' => 'permission:manage-groups']);
    $routes->post('/manage-edit-groups', 'DataGroups::edit_groups',['filter' => 'permission:manage-groups']);
    $routes->post('/manage-tambah-groups', 'DataGroups::tambah_groups',['filter' => 'permission:manage-groups']);
    $routes->post('/manage-delete-groups', 'DataGroups::delete_groups',['filter' => 'permission:manage-groups']);

    // permissions
    $routes->get('/manage-permissions', 'DataPermissions::index',['filter' => 'permission:manage-permissions']);
    $routes->get('/manage-permissions/index', 'DataPermissions::index',['filter' => 'permission:manage-permissions']);
    $routes->post('/manage-edit-permissions', 'DataPermissions::edit_permissions',['filter' => 'permission:manage-permissions']);
    $routes->post('/manage-tambah-permissions', 'DataPermissions::tambah_permissions',['filter' => 'permission:manage-permissions']);
    $routes->post('/manage-delete-permissions', 'DataPermissions::delete_permissions',['filter' => 'permission:manage-permissions']);

    // groups permissions
    $routes->get('/manage-groups-permissions', 'DataGroupsPermissions::index',['filter' => 'permission:manage-groups-permissions']);
    $routes->get('/manage-groups-permissions/index', 'DataGroupsPermissions::index',['filter' => 'permission:manage-groups-permissions']);
    $routes->post('/manage-edit-groups-permissions', 'DataGroupsPermissions::edit_groups_permissions',['filter' => 'permission:manage-groups-permissions']);
    $routes->post('/manage-tambah-groups-permissions', 'DataGroupsPermissions::tambah_groups_permissions',['filter' => 'permission:manage-groups-permissions']);
    $routes->post('/manage-delete-groups-permissions', 'DataGroupsPermissions::delete_groups_permissions',['filter' => 'permission:manage-groups-permissions']);

});
