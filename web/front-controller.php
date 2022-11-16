<?php

require_once __DIR__ . './../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();



$response = new Response();

$map = [
    '/hello' =>  '../src/pages/index.php',
    '/bye'   => '../src/pages/goodbye.php',
];

$path = $request->getPathInfo();// for a request to http://example.com/blog/index.php/post/hello-world
// the path info is "/post/hello-world"
if (isset($map[$path])) { // si le pathInfo stocké dans $path existe
    ob_start();
    include $map[$path]; // alors inclure le fichier correspondant à cette clé
    //$response->setContent(ob_get_clean());
} else { // sinon renvoyer une erreur 404
    $response->setStatusCode(404);
    $response->setContent('Not Found');
}

$response->send();