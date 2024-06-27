<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// ROUTES PENGURUS
$routes->get('/pengurus', 'Pengurus::index');
$routes->post('/pengurus/auth', 'Pengurus::auth');
$routes->get('/pengurus/logout', 'Pengurus::logout');
$routes->get('/pengurus/dashboard', 'Dashboard::index');
// Role: Administrator
$routes->get('/pengurus/master/anggota', 'Master::index_anggota');
$routes->post('pengurus/master/anggota/add', 'Master::add_anggota');
$routes->post('pengurus/master/anggota/edit/(:segment)', 'Master::edit_anggota/$1');
$routes->get('pengurus/master/anggota/delete/(:segment)', 'Master::delete_anggota/$1');

$routes->get('/pengurus/master/pengurus', 'Master::index_pengurus');
$routes->post('pengurus/master/pengurus/add', 'Master::add_pengurus');
$routes->post('pengurus/master/pengurus/edit/(:segment)', 'Master::edit_pengurus/$1');
$routes->get('pengurus/master/pengurus/delete/(:segment)', 'Master::delete_pengurus/$1');
// Role Administrator & Kasir
$routes->get('/pengurus/master/agen', 'Master::index_agen');
$routes->post('pengurus/master/agen/add', 'Master::add_agen');
$routes->post('pengurus/master/agen/edit/(:segment)', 'Master::edit_agen/$1');
$routes->get('pengurus/master/agen/delete/(:segment)', 'Master::delete_agen/$1');

$routes->get('/pengurus/master/satuan', 'Master::index_satuan');
$routes->post('pengurus/master/satuan/add', 'Master::add_satuan');
$routes->post('pengurus/master/satuan/edit/(:segment)', 'Master::edit_satuan/$1');
$routes->get('pengurus/master/satuan/delete/(:segment)', 'Master::delete_satuan/$1');

$routes->get('/pengurus/master/barang', 'Master::index_barang');
$routes->post('pengurus/master/barang/add', 'Master::add_barang');
$routes->post('pengurus/master/barang/edit/(:segment)', 'Master::edit_barang/$1');
$routes->get('pengurus/master/barang/delete/(:segment)', 'Master::delete_barang/$1');

$routes->get('/pengurus/transaksi/penjualan', 'Penjualan::index');
$routes->post('pengurus/transaksi/penjualan/cek_barang', 'Penjualan::cek_barang');
$routes->post('pengurus/transaksi/penjualan/tambah_barang', 'Penjualan::tambah_barang');
$routes->post('pengurus/transaksi/penjualan/simpan', 'Penjualan::simpan');
