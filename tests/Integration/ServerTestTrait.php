<?php

namespace Tests\Integration;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Factory\ServerRequestFactory;

trait ServerTestTrait
{
    /**
     * Create a quick server request
     *
     * @param string $method
     * @param string $uri
     * @param array $serverParams
     * @return ServerRequestInterface
     */
    protected function createRequest(string $method, string $uri, array $serverParams = []): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $uri, $serverParams);
    }
}
