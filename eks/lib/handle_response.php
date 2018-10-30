<?php 
use Eks\EksAuth;

function handle_response($app, $doc, $response, $template) {
    if (!$doc) {
        return throw_404($app, $response);
    }
    $payload = [
        'doc'        => $doc,
        'preview'    => false,
        'preview_id' => null
    ];

    $request = $app->get('request');
    $preview = $request->getQueryParam('isPreview');
    $preview_id = $request->getQueryParam('previewId');

    if ($preview && $preview === 'true') {
        if (!EksAuth::isLoggedIn()) {
            return $response->redirect('/login/');
        }        
        $payload['preview'] = true;
    }
    if ($preview_id && is_numeric($preview_id)) {
        $payload['preview_id'] = $preview_id;
    }    

    $response = $app->view->render($response, $template, $payload);
    return $response;
}