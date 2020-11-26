<?php

namespace App;

use App\Dependencies\View;
use App\Middleware\ExampleMiddleware;
use App\Handlers\HttpErrorHandler;
use App\Handlers\ShutdownHandler;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

class App
{
    /**
     * @var boolean
     */
    protected $dev_mode;

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
        $this->dev_mode = (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] == 'development' ? true : false);

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
        //---- CSRF protection
        $this->container->set('csrf', function () {
            $guard = new Guard($this->slim->getResponseFactory());

            $guard->setFailureHandler(function (
                ServerRequestInterface $request,
                RequestHandlerInterface $handler
            ): ResponseInterface {
                $status_code = 400;
                $response = $this->slim
                    ->getResponseFactory()
                    ->createResponse()
                    ->withStatus($status_code);

                return $this->container
                    ->get('view')
                    ->respond($response, 'http-error.twig', [
                        'code'        => $status_code,
                        'description' => 'There Was An Error',
                    ]);
            });

            return $guard;
        });

        //---- View
        $this->container->set('view', function () {
            return new View(
                __DIR__ . '/../resources/views',
                ($this->dev_mode ? '' : '.cache/views')
            );
        });
    }

    /**
     * Add middleware
     */
    protected function addMiddleware(): void
    {
        $this->slim->add('csrf');
        $this->slim->add(ExampleMiddleware::class);
    }

    /**
     * Define routes
     */
    protected function addRoutes(): void
    {
        require_once __DIR__ . '/../inc/routes/web.php';
    }

    /**
     * Add error handler
     */
    protected function addErrorHandler(): void
    {
        $this->error_handler = new HttpErrorHandler(
            $this->container,
            $this->slim->getCallableResolver(),
            $this->slim->getResponseFactory()
        );

        $this->slim
            ->addErrorMiddleware($this->dev_mode, false, false)
            ->setDefaultErrorHandler($this->error_handler);
    }

    /**
     * Add shutdown (fatal error) handler
     */
    protected function addShutdownHandler(): void
    {
        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request              = $serverRequestCreator->createServerRequestFromGlobals();

        $shutdownHandler = new ShutdownHandler($request, $this->error_handler, $this->dev_mode);

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
