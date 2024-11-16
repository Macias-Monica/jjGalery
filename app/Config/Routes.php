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



// Ruta para subir una nueva imagen
//$routes->match(['get', 'post'], '/gallery/upload', 'GalleryController::upload');

// Ruta para eliminar una imagen
//$routes->get('/gallery/delete/(:num)', 'GalleryController::delete/$1');

// Ruta para editar una imagen
//$routes->match(['get', 'post'], '/gallery/edit/(:num)', 'GalleryController::edit/$1');
