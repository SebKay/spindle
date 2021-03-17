<?php

namespace App\Controllers;

use App\Dependencies\View;
use Slim\Csrf\Guard;
use DI\Container;

abstract class Controller
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var Guard
     */
    protected $csrf;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->view      = $this->container->get('view');
        $this->csrf      = $this->container->get('csrf');
    }
}
