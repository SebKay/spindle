<?php

namespace App\Container;

use App\App;

abstract class Service
{
    protected $name;
    protected $container;
    protected $app;
    protected $dev_mode;

    public function __construct($container, App $app)
    {
        $this->name      = $this->setName();
        $this->container = $container;
        $this->app       = $app;
        $this->dev_mode  = $this->app->isDevModeEnabled();
    }

    public function name()
    {
        return $this->name;
    }

    abstract public function setName();

    abstract public function config();
}
