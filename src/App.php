<?php

namespace SS;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

class App
{
    /**
     * @var \Slim\App
     */
    protected $slim;

    public function __construct()
    {
        $this->slim = AppFactory::create();

        $this->setupApp();
    }
    
    protected function addRoutes(): void
    {
        $this->slim->get('/', function (ServerRequestInterface $request, ResponseInterface $response, $args) {
            $response->getBody()->write('Hello world!');
            return $response;
        });
    }

    protected function setupApp(): void
    {
        $this->addRoutes();
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->slim->handle($request);
    }

    public function run(): void
    {
        $this->slim->run();
    }
}
