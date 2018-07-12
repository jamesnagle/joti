<?php 
function handle_response($app, $doc, $response, $template) {
    if (!$doc) {
        return throw_404($app, $response);
    }

    $response = $app->view->render($response, $template, [
        'doc' => (object) $doc->toArray()
    ]);
    return $response;
}