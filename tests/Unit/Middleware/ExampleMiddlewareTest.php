<?php

namespace Tests\Unit\Middleware;

use App\Middleware\ExampleMiddleware;
use Slim\Factory\AppFactory;
use Tests\ServerTestTrait;
use Tests\Unit\Test;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ExampleMiddlewareTest extends Test
{
    use ServerTestTrait;

    /**
     * @testdox It returns a valid response when called
     */
    public function test_it_returns_a_response()
    {
        $middleware = new ExampleMiddleware();
        $request    = $this->createRequest('GET', '/');
        $hander     = AppFactory::create();

        $hander->get('/', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
            return $response;
        });

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $middleware($request, $hander));
    }
}
