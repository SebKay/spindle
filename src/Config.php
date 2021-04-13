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
        $this->services    = self::set('services');
        $this->controllers = self::set('controllers');
    }

    public static function set(string $filename): array
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
