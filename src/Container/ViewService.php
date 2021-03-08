<?php

namespace App\Container;

use App\Dependencies\View;

class ViewService extends Service
{
    public function name(): string
    {
        return 'view';
    }

    public function config(): View
    {
        return new View(
            __DIR__ . '/../../resources/views',
            ($this->dev_mode ? '' : '.cache/views')
        );
    }
}
