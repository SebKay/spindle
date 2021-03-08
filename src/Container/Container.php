<?php

namespace App\Container;

use App\App;

class Container
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
            new CSRFService($this->container, $this->app),
            new ViewService($this->container, $this->app),
        ];
    }

    public function addServices(): void
    {
        foreach ($this->services() as $service) {
            $this->container->set(
                $service->name(),
                $service->config()
            );
        }
    }

    public function setup(): void
    {
        $this->addServices();
    }

    public function get(): \DI\Container
    {
        return $this->container;
    }
}
