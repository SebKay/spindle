<?php

namespace App;

use App\Dependencies\Test;
use App\Middleware\ExampleMiddleware;
use App\Handlers\HttpErrorHandler;
use App\Handlers\ShutdownHandler;
use DI\Container;
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
     * @var Container
     */
    protected $container;

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

        $this->container = new Container();

        $this->setupContainer();

        $this->slim = AppFactory::createFromContainer($this->container);

        $this->setupApp();
    }

    /**
     * Set up the container (called in the constructor)
     */
    protected function setupContainer(): void
    {
        $this->container->set('Test', function() {
            return new Test;
        });
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
        require_once '../inc/routes/web.php';
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
