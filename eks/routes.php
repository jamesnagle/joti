<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use Eks\Models\Document;

$app->get('/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = Document::where('slug', '/')->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'home.php');
});

$app->get('/blog/', function (Request $request, Response $response, array $args) {
    $this->get('db');
    $doc = Document::where('slug', '/blog/')->with('seoMeta')->first();
    $posts = Document::where([
        ['type', '=', 'post'],
        ['status', '=', 'public']
    ])->get();

    $data = [
        'doc' => $doc, 
        'collection' => $posts
    ];

    handle_collection_response($this, $data, $response, 'blog.php');
});

$app->get('/{slug}/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = Document::where('slug', '/' . $args['slug'] . '/')->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'page.php');
});