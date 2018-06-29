<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use Eks\Models\Document;

$app->get('/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = (object) Document::where('slug', '/')->with('seoMeta')->first()->toArray();
    $response = $this->view->render($response, 'home.php', [
        'doc' => $doc
    ]);
    return $response;
});

$app->get('/about/', function (Request $request, Response $response, array $args) 
{
    $response = $this->view->render($response, 'about.php');
    return $response;
});