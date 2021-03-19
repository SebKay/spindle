<?php

namespace App;

use App\Container\ContainerCreator;
use App\Database\Database;
use App\Dependencies\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App as SlimApp;
use DI\Bridge\Slim\Bridge as AppFactory;
use Slim\Handlers\ErrorHandler as SlimErrorHandler;
use Slim\Middleware\ErrorMiddleware;

class App
{
    /**
     * @var ContainerCreator
     */
    protected $container_creator;

    /**
     * @var SlimApp
     */
    protected $slim;

    /**
     * @var ErrorMiddleware
     */
    protected $error_middleware;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Database
     */
    protected $database;

    /**
     * Set up
     */
    public function __construct()
    {
        $this->container_creator = new ContainerCreator($this);
        $this->slim              = AppFactory::create($this->container());

        $this->container_creator->setup();

        $this->logger = $this->container()->get('logger');

        $this->setupSlim();

        $this->database = new Database();
    }

    /**
     * Decide if we're in development mode or not
     *
     * @return bool
     */
    public function isDevelopmentMode(): bool
    {
        return ($_ENV['APP_ENV'] == 'development' || $_ENV['APP_ENV'] == 'test' ? true : false);
    }

    /**
     * Get the container
     *
     * @return \DI\Container
     */
    public function container(): \DI\Container
    {
        return $this->container_creator->container();
    }

    /**
     * Get the slim app
     *
     * @return SlimApp
     */
    public function slim(): SlimApp
    {
        return $this->slim;
    }

    /**
     * Add middleware
     */
    protected function addMiddleware(): void
    {
        $this->slim()->addRoutingMiddleware();

        $this->slim()->add($this->container()->get('csrf'));

        $this->error_middleware = $this->slim()->addErrorMiddleware(
            $this->isDevelopmentMode(),
            true,
            true,
            $this->logger
        );
    }

    /**
     * Add error rendering
     */
    protected function addErrorRenderers(): void
    {
        $error_handler = $this->error_middleware->getDefaultErrorHandler();

        if ($error_handler instanceof SlimErrorHandler) {
            $error_handler->registerErrorRenderer(
                'text/html',
                $this->container()->get('error-renderer-html')
            );
        }
    }

    /**
     * Define routes
     */
    protected function addRoutes(): void
    {
        require_once __DIR__ . '/../inc/routes/web.php';
    }

    /**
     * Setup the app (called in the constructor)
     */
    protected function setupSlim(): void
    {
        $this->addMiddleware();
        $this->addErrorRenderers();
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
        return $this->slim()->handle($request);
    }

    /**
     * Handle the global request and run the app
     *
     * @codeCoverageIgnore
     */
    public function run(): void
    {
        $this->slim()->run();
    }
}
