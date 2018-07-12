<?php 
function throw_404($app, $response) {
    $response = $app->view->render($response, '404.php', [
        'doc'  => (object)[
            'seo_meta'  => [
                'title'         => '404',
                'description'   => 'Not found'
            ]
        ]
    ]);
    return $response->withStatus(404);
}