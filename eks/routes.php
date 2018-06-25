<?php 
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response, array $args) 
{
    $settings = 'none';
    if ($this->has('settings')) {
        $settings = $this->settings['env'];
    }
    $response = $this->view->render($response, 'home.php', [
        'settings' => $settings
    ]);
    return $response;
});

$app->get('/about/', function (Request $request, Response $response, array $args) 
{
    $response = $this->view->render($response, 'about.php');
    return $response;
});