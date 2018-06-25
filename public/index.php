<?php 
require dirname(__FILE__) . '/../vendor/autoload.php';
require dirname(__FILE__) . '/../eks/bootstrap.php';

use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Container;
use Eks\DatabaseConfig;
use Eks\Template;

/**
 * Git Ignored, setup your own creds.
 */
$config = include(dirname(__FILE__) . '/../eks/config.php');
$mysql_db = new DatabaseConfig($config['database']);

$configuration = [
    'view'      => new PhpRenderer(dirname(__FILE__) . '/../eks/views/'),
    'settings'  => [
        'displayErrorDetails'   => true,
        'db'                    => $mysql_db->load(),
        'env'                   => $mysql_db->environment
    ]
];

$container = new Container($configuration);
$app = new App($container);

bootstrap_app($config['bootstrap'], $app);

$app->run();