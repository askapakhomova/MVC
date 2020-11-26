<?php


require '../vendor/autoload.php';
require '../vendor/deftx/gump/gump.class.php';

require '../scr/config.php';
require '../scr/eloquent.php';

/* @property-read \App\Model\Eloquent\User author */

ini_set('display_errors', 'on');
ini_set('error_reporting', E_ALL | E_NOTICE);

$route = new \Core\Route();
$route->add('/', \App\Controller\UserController::class);
$route->add('/register', \App\Controller\UserController::class);
$route->add('/login', \App\Controller\UserController::class);
$route->add('/blog', \App\Controller\BlogController::class);
$route->add('/api', \App\Controller\ApiController::class);
$route->add('/admin', \App\Controller\AdminController::class);
$route->add('/carbon', \App\Controller\CarbonController::class);
$route->add('/gump', \App\Controller\GumpController::class);
$route->add('/image', \App\Controller\ImageController::class);
$route->add('/admin/users', \App\Controller\Admin\Users::class);
$route->add('/admin/saveUser', \App\Controller\Admin\Users::class, 'saveUser');
$route->add('/admin/deleteUser', \App\Controller\Admin\Users::class, 'deleteUser');
$route->add('/admin/addUser', \App\Controller\Admin\Users::class, 'addUser');
$route->add('/admin/messages', \App\Controller\Admin\Messages::class);
$route->add('/admin/deleteUserMessage', \App\Controller\Admin\Messages::class, 'deleteUserMessage');
$route->add('/admin/addMessage', \App\Controller\Admin\Messages::class, 'addMessage');




$app = new \Core\Application($route);
$app->run();








