<?php 
function handle_collection_response($app, $data, $response, $template)
{
    extract($data);

    if (!$doc) {
        return throw_404($app, $response);
    }

    $response = $app->view->render($response, $template, [
        'doc'           => (object)$doc->toArray(),
        'collection'    => $collection->toArray()
    ]);
    return $response;
}