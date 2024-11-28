<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
#$routes->get('/', 'Home::index');
#$routes->get('/auth/login', 'Auth::login');
$routes->get('/', 'Auth::login');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/registerUser', 'Auth::registerUser');
$routes->post('/auth/loginUser', 'Auth::loginUser');
$routes->get('/auth/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('download-user-data', 'PdfController::downloadUserData');
$routes->get('download-user-data-word', 'WordExportController::downloadUserDataWord');
$routes->get('download-user-data-image', 'ImageExportController::downloadUserDataImage');

// Ruta para mostrar la galería de imágenes del usuario
//$routes->get('/gallery', 'GalleryController::index');
$routes->get('/gallery', 'Gallery::index');

// Ruta para subir una nueva imagen
$routes->post('/gallery/uploadImage', 'Gallery::uploadImage');
//ruta para eliminar la imagen
$routes->get('gallery/delete/(:num)', 'Gallery::delete/$1');

$routes->GET('gallery/edit/(:num)', 'Gallery::edit/$1'); // Ruta para abrir el modal de edición
$routes->post('gallery/update/(:num)', 'Gallery::update/$1');

