<?php

namespace App\Container;

use App\App;
use App\Config;
use App\Services\Service;

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

    protected function addServices(): void
    {
        foreach (Config::getServices() as $service_class) {
            $service = new $service_class($this->container(), $this->app);

            if ($service instanceof Service) {
                $this->container->set(
                    $service->name(),
                    $service->config()
                );
            }
        }
    }

    protected function addControllers(): void
    {
        foreach (Config::getControllers() as $controller) {
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
