<?php
define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS . '..'. DS, TRUE);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// AUTOLOAD - CLASSMAP
require BASE_PATH . 'vendor'.DS.'autoload.php';

// ORM - PROPEL
require BASE_PATH . 'generated-conf'.DS.'config.php';

// VIEW - TWIG
$loader = new \Twig\Loader\FilesystemLoader(BASE_PATH . 'app'.DS.'views');
$twig   = new \Twig\Environment($loader, [
    'cache' => BASE_PATH . 'cache'.DS.'views',
    'debug' => true,
]);

// INIT APP
$app          = System\App::instance();
$app->request = System\Request::instance();
$app->route   = System\Route::instance($app->request);
$app->view    = $twig;
$route        = $app->route;

require BASE_PATH . 'app'.DS.'routes.php';

$route->end();
