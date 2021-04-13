<?php

namespace App;

class Config
{
    /**
     * @var array
     */
    protected $services;

    /**
     * @var array
     */
    protected $controllers;

    public function __construct()
    {
        $this->services    = $this->set('services');
        $this->controllers = $this->set('controllers');
    }

    protected function set(string $filename): array
    {
        $file = __DIR__ . "/../config/$filename.php";

        if (!file_exists($file)) {
            return [];
        }

        return include $file;
    }

    public static function getServices(): array
    {
        return (new self())->services;
    }

    public static function getControllers(): array
    {
        return (new self())->controllers;
    }
}
