<?php

namespace App\Services;

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
