<?php

namespace Config;

use App\Controllers\Pages;
// use App\Controllers\CtrHmenu;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);

$routes->group('hmenu', static function ($routes) {
    $routes->get('show', 'CtrHmenu::index');
    $routes->post('create', 'CtrHmenu::add');
    $routes->get('edit/(:any)', 'CtrHmenu::edit/$1');
    $routes->post('update/(:any)', 'CtrHmenu::update/$1');
});

$routes->group('menu', static function ($routes) {
    $routes->get('show', 'CtrMenu::index');
    $routes->post('create', 'CtrMenu::add');
    $routes->get('edit/(:any)', 'CtrMenu::edit/$1');
    $routes->post('update/(:any)', 'CtrMenu::update/$1');
});

$routes->group('smenu', static function ($routes) {
    $routes->get('show', 'CtrSubmenu::index');
    $routes->post('create', 'CtrSubmenu::add');
    $routes->get('edit/(:any)', 'CtrSubmenu::edit/$1');
    $routes->get('menus/(:any)', 'CtrSubmenu::menus/$1');
    $routes->get('menus/', 'CtrSubmenu::menus');
    $routes->post('update/(:any)', 'CtrSubmenu::update/$1');
});
$routes->resource('list_barang', ['controller' => 'CtrDlb']);
$routes->resource('listb', ['controller' => 'CtrListBarang']);


$routes->group('api', static function ($routes) {
    $routes->post('(:any)/(:any)/(:any)/(:any)/approve', 'CtrListBarang::approve/$1/$2/$3/$4');
    $routes->get('approve', 'CtrListBarang::showApprove');
});

$routes->group('report', static function ($routes) {
    $routes->get('(:any)/bm', 'CtrReport::barang_masuk/$1');
    // $routes->get('approve', 'CtrListBarang::showApprove');
});

// $routes->presenter('list_barang', ['controller' => 'CtrListBarang']);
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
