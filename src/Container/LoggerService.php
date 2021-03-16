<?php

namespace App\Container;

use App\Logging\Logger;

class LoggerService extends Service
{
    public static function name(): string
    {
        return 'logger';
    }

    public function config(): Logger
    {
        return new Logger();
    }
}
