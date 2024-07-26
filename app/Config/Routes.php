<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


//profil dan logout //
$routes->get('/', 'Login::index');

$routes->post('/processChangePassword', 'Login::processChangePassword');
$routes->post('/save_editprofil', 'Login::save_editprofil');
//akhir profil dan logout //

//start user//
$routes->get('/user', 'User::index', ['filter' => 'role:user']);
$routes->get('/user/index', 'User::index', ['filter' => 'role:user']);
$routes->delete('/user/delete/(:num)', 'User::delete/$1', ['filter' => 'role:user']);
$routes->get('/user/edit/(:num)', 'User::edit/$1', ['filter' => 'role:user']);
$routes->post('/user/save_edit/(:num)', 'User::save_edit/$1', ['filter' => 'role:user']);
$routes->get('/user/status', 'User::status', ['filter' => 'role:user']);
$routes->get('/user/excel', 'user::excel', ['filter' => 'role:user']);
$routes->post('/user/save_data', 'User::save_data', ['filter' => 'role:user']);

//end start user //

//start Admin//
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/tambah_program', 'Admin::tambah_program', ['filter' => 'role:admin']);
$routes->post('/admin/saveprogram', 'Admin::saveprogram', ['filter' => 'role:admin']);
$routes->get('/admin/viewprogram', 'Admin::viewprogram', ['filter' => 'role:admin']);
$routes->delete('/admin/deletedata/(:num)', 'Admin::deletedata/$1', ['filter' => 'role:admin']);
$routes->get('/admin/edit/(:num)', 'admin::edit/$1', ['filter' => 'role:admin']);
$routes->post('/admin/saveedit/(:num)', 'admin::saveedit/$1', ['filter' => 'role:admin']);
$routes->get('/admin/viewtambahdata', 'Admin::viewtambahdata', ['filter' => 'role:admin']);
$routes->post('/admin/savetambahdata', 'Admin::savetambahdata', ['filter' => 'role:admin']);
$routes->get('/admin/permintaan_admin', 'admin::permintaan_admin', ['filter' => 'role:admin']);
$routes->get('/admin/status_admin', 'admin::status_admin', ['filter' => 'role:admin']);
$routes->post('/admin/save_data', 'admin::save_data', ['filter' => 'role:admin']);
$routes->get('/admin/exceladmin', 'admin::exceladmin', ['filter' => 'role:admin']);
//end start user //

//start Finance//
$routes->get('/finance', 'finance::index', ['filter' => 'role:finance']);
$routes->get('/finance/index', 'finance::index', ['filter' => 'role:finance']);
$routes->get('/finance/viewdata(:any)', 'finance::viewdata/$1', ['filter' => 'role:finance']);
$routes->get('/finance/reject(:any)', 'finance::reject/$1', ['filter' => 'role:finance']);
$routes->post('/finance/save_reject/(:num)', 'finance::save_reject/$1', ['filter' => 'role:finance']);
$routes->post('/finance/save_data_permintaan', 'finance::save_data_permintaan', ['filter' => 'role:finance']);
$routes->get('/finance/history', 'finance::history', ['filter' => 'role:finance']);
$routes->get('/finance/excel', 'finance::excel', ['filter' => 'role:finance']);
$routes->get('/finance/permintaan_finance', 'finance::permintaan_finance', ['filter' => 'role:finance']);
$routes->get('/finance/status_finance', 'finance::status_finance', ['filter' => 'role:finance']);
$routes->post('/finance/save_data', 'finance::save_data', ['filter' => 'role:finance']);
$routes->get('/finance/excel_permintaan', 'finance::excel_permintaan', ['filter' => 'role:finance']);



//start Manager//
$routes->get('/manager', 'manager::index', ['filter' => 'role:direktur']);
$routes->get('/manager/index', 'manager::index', ['filter' => 'role:direktur']);
$routes->get('/manager/permintaan_manager', 'manager::permintaan_manager', ['filter' => 'role:direktur']);
$routes->get('/manager/viewdata(:any)', 'manager::viewdata/$1', ['filter' => 'role:direktur']);
$routes->post('/manager/savedata', 'manager::savedata', ['filter' => 'role:direktur']);
$routes->get('/manager/history_manager', 'manager::history_manager', ['filter' => 'role:direktur']);
$routes->post('/manager/save_data', 'manager::save_data', ['filter' => 'role:direktur']);
$routes->get('/manager/manager_status', 'manager::manager_status', ['filter' => 'role:direktur']);


$routes->get('/manager/excel', 'manager::excel', ['filter' => 'role:direktur']);

//end start user //