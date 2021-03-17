<?php

namespace App;

use App\Dependencies\View;
use DI\Container;
use Slim\Interfaces\ErrorRendererInterface;

class ErrorRendererHTML implements ErrorRendererInterface
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var View
     */
    protected $view;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->view      = $this->container->get('view');
    }

    public function __invoke(\Throwable $exception, bool $displayErrorDetails): string
    {
        return $this->view->render('layouts/http-error.twig', [
            'code'        => $exception->getCode(),
            'description' => Helpers::getHttpStatusMessage($exception->getCode()),
        ]);
    }
}
