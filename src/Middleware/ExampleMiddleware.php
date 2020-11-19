<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExampleMiddleware
{
    /**
     * Run after everything else
     *
     * @param  ServerRequestInterface  $request PSR-7 request
     * @param  RequestHandlerInterface $handler PSR-15 request handler
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);

        $response->getBody()->write(' AFTER');

        return $response;
    }
}
