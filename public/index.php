<?php 
require dirname(__FILE__) . '/../vendor/autoload.php';

use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Container;

$configuration = [
    'view'      => new PhpRenderer(dirname(__FILE__) . '/../eks/views/'),
    'settings'  => [
        'displayErrorDetails' => true
    ]
];
$container = new Container($configuration);
$app = new App($container);

require dirname(__FILE__) . '/../eks/bootstrap.php';

$app->run();