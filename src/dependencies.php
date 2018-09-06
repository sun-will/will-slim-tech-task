<?php

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Jwt Middleware
$container['jwt'] = function ($c) {
    $jws_settings = $c->get('settings')['jwt'];
    return new \Slim\Middleware\JwtAuthentication($jws_settings);
};

// Request Validator
$container['validator'] = function ($c) {
    return new \App\Validation\Validator();
};

// Error Handler
$container['errorHandler'] = function ($c) {
    return new \App\Exceptions\ErrorHandler($c['settings']['displayErrorDetails']);
};