<?php

namespace App\Services;

use App\Dependencies\Logger;

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
