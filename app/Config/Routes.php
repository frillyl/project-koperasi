<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// ROUTES PENGURUS
$routes->get('/pengurus/login', 'Pengurus::index');
$routes->post('/pengurus/login/auth', 'Pengurus::auth');
$routes->get('/pengurus/logout', 'Pengurus::logout');
$routes->get('/pengurus/dashboard', 'Dashboard::index');
// Role: Administrator
$routes->get('/pengurus/master/anggota', 'Master::index_anggota');
$routes->post('pengurus/master/anggota/add', 'Master::add_anggota');
$routes->post('pengurus/master/anggota/edit/(:segment)', 'Master::edit_anggota/$1');
$routes->get('pengurus/master/anggota/delete/(:segment)', 'Master::delete_anggota/$1');
$routes->get('/pengurus/laporan/anggota', 'Laporan::index_anggota');

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
$routes->get('/pengurus/laporan/barang', 'Laporan::index_barang');

$routes->get('/pengurus/transaksi/penjualan', 'Penjualan::index');
$routes->post('pengurus/transaksi/penjualan/cek_barang', 'Penjualan::cek_barang');
$routes->post('pengurus/transaksi/penjualan/tambah_barang', 'Penjualan::tambah_barang');
$routes->post('pengurus/transaksi/penjualan/simpan', 'Penjualan::simpan');
$routes->get('/pengurus/laporan/penjualan', 'Laporan::index_penjualan');
$routes->get('pengurus/laporan/getDetailPenjualan', 'Laporan::getDetailPenjualan');
$routes->get('pengurus/laporan/cetak_pdf', 'Laporan::cetak_pdf');
$routes->get('pengurus/laporan/cetak_penjualan', 'Laporan::cetak_penjualan');

$routes->get('/pengurus/akuntansi/akun', 'Akuntansi::index_akun');
$routes->get('/pengurus/akuntansi/akun/kelola', 'Akuntansi::kelola_akun');
$routes->post('pengurus/akuntansi/akun/kelola/add', 'Akuntansi::add_akun');
$routes->post('pengurus/akuntansi/akun/kelola/edit/(:segment)', 'Akuntansi::edit_akun/$1');
$routes->get('/pengurus/akuntansi/akun/kelola/delete/(:segment)', 'Akuntansi::delete_akun/$1');

$routes->get('/pengurus/akuntansi/akun_header', 'Akuntansi::index_header');
$routes->post('pengurus/akuntansi/akun_header/add', 'Akuntansi::add_header');
$routes->post('pengurus/akuntansi/akun_header/edit/(:segment)', 'Akuntansi::edit_header/$1');
$routes->get('/pengurus/akuntansi/akun_header/delete/(:segment)', 'Akuntansi::delete_header/$1');
$routes->get('/pengurus/akuntansi/akun_pembantu', 'Akuntansi::index_bantu');
$routes->get('/pengurus/akuntansi/akun_pembantu/kelola', 'Akuntansi::kelola_bantu');
$routes->post('pengurus/akuntansi/akun_pembantu/kelola/add', 'Akuntansi::add_bantu');
$routes->post('pengurus/akuntansi/akun_pembantu/kelola/edit/(:segment)', 'Akuntansi::edit_bantu/$1');
$routes->get('/pengurus/akuntansi/akun_pembantu/kelola/delete/(:segment)', 'Akuntansi::delete_bantu/$1');

$routes->get('/pengurus/akuntansi/jurnal_umum', 'Akuntansi::index_jurnal');
$routes->get('/pengurus/akuntansi/jurnal_umum/kelola', 'Akuntansi::kelola_jurnal');
$routes->post('pengurus/akuntansi/jurnal_umum/kelola/add', 'Akuntansi::add_jurnal');
$routes->post('pengurus/akuntansi/jurnal_umum/kelola/edit/(:segment)', 'Akuntansi::edit_jurnal/$1');
$routes->get('/pengurus/akuntansi/jurnal_umum/kelola/delete/(:segment)', 'Akuntansi::delete_jurnal/$1');

$routes->get('/pengurus/akuntansi/buku_besar', 'Akuntansi::index_bukubesar');
$routes->post('pengurus/akuntansi/buku_besar/cariData', 'Akuntansi::cariData');

$routes->get('/pengurus/akuntansi/buku_pembantu', 'Akuntansi::index_bukupembantu');
$routes->post('pengurus/akuntansi/buku_pembantu/cariData', 'Akuntansi::cariDataBantu');

$routes->get('/pengurus/akuntansi/neraca_lajur', 'Akuntansi::index_neracalajur');

$routes->get('/pengurus/akuntansi/laba_rugi', 'Akuntansi::index_labarugi');

$routes->get('/pengurus/akuntansi/neraca', 'Akuntansi::index_neraca');

$routes->get('/pengurus/akuntansi/perubahan_modal', 'Akuntansi::index_pmodal');

$routes->get('/pengurus/usipa/simpanan', 'SimpanPinjam::index_simpanan');
$routes->post('pengurus/usipa/simpanan/add', 'SimpanPinjam::index_simpanan');

$routes->get('/pengurus/usipa/pinjaman', 'SimpanPinjam::index_pinjaman');
$routes->post('pengurus/usipa/pinjaman/add', 'SimpanPinjam::add_pinjaman');
$routes->get('/pengurus/usipa/pangkat/getById/(:num)', 'PinjamanController::getPangkatById/$1');

$routes->get('/pengurus/usipa/angsuran', 'SimpanPinjam::index_angsuran');
