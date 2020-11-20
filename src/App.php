<?php

namespace App;

use App\Middleware\ExampleMiddleware;
use App\Handlers\HttpErrorHandler;
use App\Handlers\ShutdownHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

class App
{
    /**
     * @var boolean
     */
    protected $display_errors;

    /**
     * @var \Slim\App
     */
    protected $slim;

    /**
     * @var HttpErrorHandler
     */
    protected $error_handler;

    /**
     * Set up
     */
    public function __construct()
    {
        $this->display_errors = ($_ENV['APP_ENV'] == 'development' ? true : false);

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
     * Add error handler
     */
    protected function addErrorHandler(): void
    {
        $this->error_handler = new HttpErrorHandler(
            $this->slim->getCallableResolver(),
            $this->slim->getResponseFactory()
        );

        $this->slim
            ->addErrorMiddleware($this->display_errors, false, false)
            ->setDefaultErrorHandler($this->error_handler);
    }

    /**
     * Add shutdown (fatal error) handler
     */
    protected function addShutdownHandler(): void
    {
        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request              = $serverRequestCreator->createServerRequestFromGlobals();

        $shutdownHandler = new ShutdownHandler($request, $this->error_handler, $this->display_errors);

        \register_shutdown_function($shutdownHandler);
    }

    /**
     * Setup the app (called in the constructor)
     */
    protected function setupApp(): void
    {
        $this->addMiddleware();
        $this->addRoutes();

        $this->slim->addRoutingMiddleware();
        $this->addErrorHandler();
        $this->addShutdownHandler();
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
