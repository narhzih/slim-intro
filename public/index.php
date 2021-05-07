<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

require __DIR__."/../vendor/autoload.php";

$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Add a simple middleware to handle request
$app->add(function(Request $request, RequestHandler $requestHandler) {
    return $requestHandler->handle($request);

});

$app->get('/', function(Request $request, Response $response, array $args) {
    $response->getBody()->write("Welcome to my slim application");
    return $response;
});

$app->run();