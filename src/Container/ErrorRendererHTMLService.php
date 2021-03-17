<?php

namespace App\Container;

use App\ErrorRendererHTML;

class ErrorRendererHTMLService extends Service
{
    public static function name(): string
    {
        return 'error-renderer-html';
    }

    public function config(): string
    {
        return ErrorRendererHTML::class;
    }
}
