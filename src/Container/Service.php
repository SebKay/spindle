<?php

namespace App\Container;

use App\App;

abstract class Service
{
    /**
     * @var \DI\Container
     */
    protected $container;

    /**
     * @var App
     */
    protected $app;

    /**
     * @var bool
     */
    protected $dev_mode;

    public function __construct(\DI\Container $container, App $app)
    {
        $this->container = $container;
        $this->app       = $app;
        $this->dev_mode  = $this->app->isDevelopmentMode();
    }

    abstract public static function name(): string;

    abstract public function config();
}
