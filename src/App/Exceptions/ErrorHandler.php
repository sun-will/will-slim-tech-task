<?php

namespace App\Exceptions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\Error;
use Slim\Handlers\NotFound;


class ErrorHandler extends Error {

    /** @inheritdoc */
    public function __construct(bool $displayErrorDetails)
    {
        parent::__construct($displayErrorDetails);
    }

    /** @inheritdoc */
    public function __invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response, 
        \Exception $exception) {
            return (new NotFound())($request, $response);
    }
}