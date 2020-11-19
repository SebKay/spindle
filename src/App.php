<?php

namespace App;

use App\Middleware\ExampleMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

class App
{
    /**
     * @var \Slim\App
     */
    protected $slim;

    /**
     * Set up
     */
    public function __construct()
    {
        $this->slim = AppFactory::create();

        $this->setupApp();
    }

    /**
     * Add middleware
     */
    protected function addMiddleware(): void
    {
        $this->slim->add(new ExampleMiddleware());
    }

    /**
     * Define routes
     */
    protected function addRoutes(): void
    {
        $this->slim->get('/', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
            $response->getBody()->write('Hello world!');
            return $response;
        });
    }

    /**
     * Setup the app (called in the constructor)
     */
    protected function setupApp(): void
    {
        $this->addMiddleware();
        $this->addRoutes();
    }

    /**
     * Hanndle a request object
     *
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->slim->handle($request);
    }

    /**
     * Handle the global request and run the app
     * 
     * @codeCoverageIgnore
     */
    public function run(): void
    {
        $this->slim->run();
    }
}
