<?php

namespace App\Container;

use App\Dependencies\View;

class ViewService extends Service
{
    public function setName()
    {
        return 'view';
    }

    public function config()
    {
        return new View(
            __DIR__ . '/../../resources/views',
            ($this->dev_mode ? '' : '.cache/views')
        );
    }
}
