<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use Eks\Models\Document;

$app->get('/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = Document::where('slug', '/')->with('seoMeta')->first();

    if (!$doc) {
        $response = $this->view->render($response, '404.php', [
            'doc' => (object) [
                'seo_meta' => [
                    'title' => '404',
                    'description' => 'Not found'
                ]
            ]
        ]);
        return $response->withStatus(404);
    } 

    $response = $this->view->render($response, 'home.php', [
        'doc' => (object) $doc->toArray()
    ]);
    return $response;
});

$app->get('/{slug}/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = Document::where('slug', '/' . $args['slug'] . '/')->with('seoMeta')->first();

    if (!$doc) {
        $response = $this->view->render($response, '404.php', [
            'doc' => (object) [
                'seo_meta' => [
                    'title' => '404',
                    'description' => 'Not found'
                ]
            ]
        ]);
        return $response->withStatus(404);
    } 

    $response = $this->view->render($response, 'page.php', [
        'doc' => (object) $doc->toArray()
    ]);
    return $response;
});