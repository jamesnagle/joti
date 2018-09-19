<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use Eks\Models\Document;
use Eks\Models\Revision;
use Eks\EksAuth;
use Eks\Controllers\LoginController;
use SebastianBergmann\Diff\Differ;

$app->get('/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = Document::where('slug', '/')->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'home.php');
})->setName('home');

$app->get('/blog/', function (Request $request, Response $response, array $args) {
    $this->get('db');
    $doc = Document::where('slug', '/blog/')->with('seoMeta')->first();
    $posts = Document::where([
        ['type', '=', 'post'],
        ['category_id', '!=', 5],
        ['status', '=', 'public']
    ])->get();

    $data = [
        'doc' => $doc, 
        'collection' => $posts
    ];

    handle_collection_response($this, $data, $response, 'blog.php');
});

$app->get('/skills/', function (Request $request, Response $response, array $args) {
    $this->get('db');
    $doc = Document::where('slug', '/skills/')->with('seoMeta')->first();
    $skills = Document::where([
        ['type', '=', 'post'],
        ['category_id', '=', 4],
        ['status', '=', 'public']
    ])->get();

    $data = [
        'doc' => $doc,
        'collection' => $skills
    ];

    handle_collection_response($this, $data, $response, 'skills.php');
});
$app->get('/skills/{slug}/', function (Request $request, Response $response, array $args) {
    $this->get('db');

    $doc = Document::where([
        ['slug', '=', '/' . $args['slug'] . '/'],
        ['category_id', '=', 4]
    ])->with('seoMeta')->first();

    $data = [
        'doc' => $doc,
        'collection' => $doc->lessons
    ];

    handle_collection_response($this, $data, $response, 'skill.php');
});
$app->get('/skills/{slug}/{lesson}/', function (Request $request, Response $response, array $args) {
    $this->get('db');
    $parent_doc = Document::where([
        ['slug', '=', '/' . $args['slug'] . '/'],
        ['category_id', '=', 4]
    ])->first();

    $doc = Document::where([
        ['slug', '=', '/' . $args['lesson'] . '/'],
        ['type', '=', 'post'],
        ['category_id', '=', 5],
        ['status', '=', 'public']
    ])
    ->whereHas('skill', function($query) use ($parent_doc) {
        $query->where('skill_id', '=', $parent_doc->id);
    })->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'lesson.php');
});

$app->get('/blog/{slug}/', function (Request $request, Response $response, array $args) {
    $this->get('db');
    $doc = Document::where([
        ['slug', '=', '/' . $args['slug'] . '/'],
        ['type', '=', 'post'],
        ['status', '=', 'public']
    ])->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'post.php');
});

$app->get('/login/', function (Request $request, Response $response, array $args) {

    session_start();

    $router = $this->get('router');

    if (EksAuth::isLoggedIn()) {
        return $response->withRedirect($router->pathFor('admin'));
    }

    $this->get('db');
    $doc = Document::where('slug', '/login/')->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'login.php');
})->setName('login');

$app->post('/login/', function (Request $request, Response $response, array $args) {
    
    $this->get('db');
    $router = $this->get('router');

    $post_array = $request->getParsedBody();

    switch ($post_array['form']) {
        case 'login':
            return LoginController::post($request, $response, $router);
            break;
        
        default:
            return $response->withRedirect($router->pathFor('login'), 302);
            break;
    }
});

$app->get('/admin/', function (Request $request, Response $response, array $args) {
    session_start();

    $router = $this->get('router');

    if (!EksAuth::isLoggedIn()) {
        return $response->withRedirect($router->pathFor('login'), 302);
    }
    $this->get('db');
    $doc = Document::where('slug', '/admin/')->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'admin/index.php');
})->setName('admin');

$app->get('/logout/', function (Request $request, Response $response, array $args) {

    $router = $this->get('router');

    session_start();

    EksAuth::logout();

    return $response->withRedirect($router->pathFor('home'));

})->setName('logout');

$app->get('/{slug}/', function (Request $request, Response $response, array $args) 
{
    $this->get('db');
    $doc = Document::where('slug', '/' . $args['slug'] . '/')->with('seoMeta')->first();

    handle_response($this, $doc, $response, 'page.php');
});

$app->post('/api/document/draft', function (Request $request, Response $response, array $args) 
{
    $this->get('db');

    $post_array = $request->getParsedBody();

    $doc = Document::with('draft')->findOrFail($post_array['document_id']);

    $draft = $doc->draft();


    if ($draft->get()->first()) {
        $fill_array = [];
        $fill_array[$post_array['type']] = $post_array['data'];
        
        $draft->update($fill_array);
    } else {
        $slug = array_filter(explode('/', $doc->slug));
        $data = [
            'slug' => '/' . implode('', $slug) . '-draft/',
            'type' => 'draft',
            'status' => 'private',
            'category_id' => $doc->category_id
        ];
        if ($post_array['type'] === 'title') {
            $data['title'] = $post_array['data'];
            $data['body'] = $doc->body;
        }
        if ($post_array['type'] === 'body') {
            $data['title'] = $doc->title;
            $data['body'] = $post_array['data'];
        }
        $draft->create($data);
    }

    return $response->withJson(['response' => 'ok']);
});
$app->post('/api/document/update', function (Request $request, Response $response, array $args) 
{
    $this->get('db');

    $post_array = $request->getParsedBody();

    extract($post_array);

    $doc = Document::with('draft')->findOrFail($document_id);
    $meta = $doc->seoMeta();

    $differ = new Differ();
    $diff = $differ->diff($doc->body, $body);

    Revision::create([
        'document_id'   => intval($document_id),
        'body'          => $diff
    ]);

    $doc->update([
        'title'     => $title,
        'body'      => $body,
        'status'    => $status,
    ]);

    $meta->update([
        'title'         => $seo_title,
        'description'   => $seo_description,
        'index'         => intval($index),
        'nofollow'      => intval($nofollow)
    ]);

    return $response->withJson(['response' => 'ok']);
});