<?php
require '../vendor/autoload.php';
require '../scr/config.php';

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);

$route = new \Core\Route();
$route->add('/', \App\Controller\LoginController::class);
$route->add('/register', \App\Controller\UserController::class);
$route->add('/login', \App\Controller\UserController::class);
$route->add('/blog', \App\Controller\BlogController::class);
$route->add('/api', \App\Controller\ApiController::class);
$route->add('/admin', \App\Controller\AdminController::class);

$app = new \Core\Application($route);
$app->run();






