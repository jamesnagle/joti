<?php 
use Slim\Views\PhpRenderer;
use Slim\Container;
use Eks\DatabaseConfig;
use Eks\Template;
use Illuminate\Database\Capsule\Manager;

$config = include(EKS_DIRECTORY . 'config.php');
$mysql_db = new DatabaseConfig($config['database']);

$app_config = [
    'settings' => [
        'displayErrorDetails' => true,
        'db' => $mysql_db->load(),
        'env' => $mysql_db->environment
    ]
];

$container = new Container($app_config);

$container['db'] = function ($container) {
    $capsule = new Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$container['view'] = function ($container) {
    $templateVariables = [
        'request' => $container->get('request')
    ];
    return new \Slim\Views\PhpRenderer(EKS_DIRECTORY . 'views/', $templateVariables);
};

return $container;