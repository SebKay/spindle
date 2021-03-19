<?php

namespace App;

class Config
{
    protected $services;
    protected $controllers;

    public function __construct()
    {
        $this->services = $this->setServices();
        $this->controllers = $this->setControllers();
    }

    protected function setServices(): array
    {
        $file = __DIR__ . '/../config/services.php';

        if (!file_exists($file)) {
            return [];
        }

        return include $file;
    }

    public static function getServices(): array
    {
        return (new self())->services;
    }

    protected function setControllers(): array
    {
        $file = __DIR__ . '/../config/controllers.php';

        if (!file_exists($file)) {
            return [];
        }

        return include $file;
    }

    public static function getControllers(): array
    {
        return (new self())->controllers;
    }
}
