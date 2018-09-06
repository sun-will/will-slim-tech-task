<?php

use App\Controllers\TwitterController;
use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    // Render index view
    return $response->getBody()->write("Try /hello/:name");
});

$app->get('/hello/{name}/', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    // Render index view
    return $response->getBody()->write("Hello, $name");
});

$app->get('/histogram/{name}/', TwitterController::class . ':show')->setName('histogram.show');
