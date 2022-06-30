<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->post('/login', 'Auth::login');

$routes->get('/dashboard', 'Admin::index');
$routes->get('/surat/masuk', 'Admin::surat_masuk');
$routes->get('/surat/keluar', 'Admin::surat_keluar');
$routes->get('/surat/keluar/permintaan', 'Admin::permintaan');
$routes->get('/agenda/surat-masuk', 'Admin::agenda_surat_masuk');
$routes->get('/agenda/surat-keluar', 'Admin::agenda_surat_keluar');
$routes->get('/kategori', 'Admin::kategori');
$routes->get('/kategori/(:any)', 'Admin::sub_kategori');

$routes->group('admin', function($routes){
	$routes->get('surat-masuk/(:any)/detail', 'SuratMasuk::get/$1');
    $routes->post('surat-masuk', 'SuratMasuk::insert');
	$routes->post('surat-masuk/(:any)/edit', 'SuratMasuk::edit/$1');
	$routes->get('surat-masuk/(:any)/delete', 'SuratMasuk::delete/$1');
	$routes->get('cari-sm', 'SuratMasuk::search');
	$routes->get('cari-asm', 'SuratMasuk::searchAgenda');
	$routes->get('download/file-sm/(:any)', 'SuratMasuk::download_file/$1');

	$routes->post('agenda/surat-masuk/filter', 'SuratMasuk::agenda_filter');
	$routes->get('agenda/surat-masuk/download', 'SuratMasuk::agenda_download');

	$routes->get('kategori/(:any)/detail', 'Kategori::get/$1');
    $routes->post('kategori', 'Kategori::insert');
	$routes->post('kategori/(:any)/edit', 'Kategori::edit/$1');
	$routes->get('kategori/(:any)/delete', 'Kategori::delete/$1');

	$routes->get('sub-kategori/(:any)/detail', 'SubKategori::get/$1');
    $routes->post('sub-kategori', 'SubKategori::insert');
	$routes->post('sub-kategori/(:any)/edit', 'SubKategori::edit/$1');
	$routes->get('sub-kategori/(:any)/delete', 'SubKategori::delete/$1');

	$routes->get('surat-keluar/init/(:any)', 'SuratKeluar::init/$1');
	$routes->get('surat-keluar/sub-kategori/(:any)', 'SuratKeluar::sub_kategori/$1');
	$routes->get('surat-keluar/(:any)/detail', 'SuratKeluar::get/$1');
    $routes->post('surat-keluar', 'SuratKeluar::create');
	$routes->post('surat-keluar/edit', 'SuratKeluar::edit');
	$routes->get('surat-keluar/delete/(:any)', 'SuratKeluar::delete/$1');
	$routes->get('permintaan/(:any)/delete', 'SuratKeluar::delete_permintaan/$1');

	$routes->post('agenda/surat-keluar/filter', 'SuratKeluar::agenda_filter');
	$routes->get('agenda/surat-keluar/download', 'SuratKeluar::agenda_download');
	$routes->get('cari-ask', 'SuratKeluar::searchAgenda');
	$routes->get('cari-sk', 'SuratKeluar::search');

	$routes->post('disposisi', 'Disposisi::insert');
	$routes->get('disposisi/(:any)', 'Disposisi::get/$1');
	$routes->get('download/file-dsp/(:any)', 'Disposisi::download_file/$1');
});

$routes->get('/permintaan', 'Permintaan::index');
$routes->post('/permintaan', 'Permintaan::insert');
$routes->get('/permintaan/success', 'Permintaan::response');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
