<?php

namespace App\Controllers;

use App\Helpers;
use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * Set up
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * When loading the route
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->container->get('View')->respond(
            $response,
            'home.twig',
            [
                'name'   => 'Jim',
                'csrf'   => Helpers::generateCSRFData($this->container->get('csrf'), $request)
            ]
        );
    }

    /**
     * When updating the form
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        echo '<pre>';
        var_dump($request->getAttributes());
        echo '</pre>';

        return $this->container->get('View')->respond(
            $response,
            'home.twig',
            [
                'name' => 'Jim',
                'csrf' => Helpers::generateCSRFData($this->container->get('csrf'), $request),
                'form' => (array) $request->getParsedBody()
            ]
        );
    }
}
