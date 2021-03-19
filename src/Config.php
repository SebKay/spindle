<?php

namespace App;

class Config
{
    protected $services;

    public function __construct()
    {
        $this->services = $this->setServices();
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
}
