<?php

namespace App\Container;

use App\App;
use App\Controllers\HomeController;

class ContainerCreator
{
    /**
     * @var App
     */
    protected $app;

    /**
     * @var \DI\Container
     */
    protected $container;

    public function __construct(App $app)
    {
        $this->app       = $app;
        $this->container = new \DI\Container();
    }

    protected function services(): array
    {
        return [
            LoggerService::class,
            CSRFService::class,
            ViewService::class
        ];
    }

    protected function addServices(): void
    {
        foreach ($this->services() as $service_class) {
            /**
             * @var Service
             */
            $service = new $service_class($this->container(), $this->app);

            if ($service instanceof Service) {
                $this->container->set(
                    $service->name(),
                    $service->config()
                );
            }
        }
    }

    protected function controllers(): array
    {
        return [
            HomeController::class
        ];
    }

    protected function addControllers(): void
    {
        foreach ($this->controllers() as $controller) {
            $this->container->set(
                $controller,
                new $controller($this->container())
            );
        }
    }

    public function setup(): void
    {
        $this->addServices();
        $this->addControllers();
    }

    public function container(): \DI\Container
    {
        return $this->container;
    }
}
