<?php 
use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response, array $args) 
{
    $response = $this->view->render($response, 'home.php'/*, ['tickets' => $tickets]*/);
    return $response;
});