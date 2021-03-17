<?php

namespace App;

use Slim\Interfaces\ErrorRendererInterface;

class ErrorRendererHTML implements ErrorRendererInterface
{
    public function __invoke(\Throwable $exception, bool $displayErrorDetails): string
    {
        return 'My awesome format';
    }
}
