<?php

namespace App\Exceptions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\Error;
use Slim\Handlers\NotFound;


class ErrorHandler extends Error {

    public function __construct(bool $displayErrorDetails) {
        parent::__construct($displayErrorDetails);
    }

    /**
     * Invoke the errorhandler
     *
     * @param ServerRequestInterface $values
     * @param ResponseInterface $response
     *
     * @return NotFound
     */
    public function invoke(
        ServerRequestInterface $request, 
        ResponseInterface $response, 
        \Exception $exception) {
            return (new NotFound())($request, $response);
    }
}