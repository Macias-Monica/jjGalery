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

