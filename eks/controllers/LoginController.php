<?php 
namespace Eks\Controllers;

use Eks\EksAuth;
use Slim\Http\Request;
use Slim\Http\Response;

class LoginController 
{
    public static function post(Request $request, Response $response, $router) {
        extract($request->getParsedBody());

        if (EksAuth::login($username, $password)) {
            return $response->withRedirect($router->pathFor('admin'));
        } else {
            return $response->withRedirect($router->pathFor('login'));
        }
    }
}