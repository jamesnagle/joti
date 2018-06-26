<?php 
require dirname(__FILE__) . '/../vendor/autoload.php';
require dirname(__FILE__) . '/../eks/bootstrap.php';

use Slim\App;

$container = include(EKS_DIRECTORY . 'init.php');

$app = new App($container);

bootstrap_app($config['bootstrap'], $app);

$app->run();