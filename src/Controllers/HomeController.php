<?php

namespace App\Controllers;

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
        $csrf     = $this->container->get('csrf');
        $nameKey  = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();

        return $this->container->get('View')->respond(
            $response,
            'home.twig',
            [
                'name'   => 'Jim',
                'csrf'   => [
                    'keys' => [
                        'name'  => $nameKey,
                        'value' => $valueKey
                    ],
                    'name'  => $request->getAttribute($nameKey),
                    'value' => $request->getAttribute($valueKey)
                ],
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
        $csrf     = $this->container->get('csrf');
        $nameKey  = $csrf->getTokenNameKey();
        $valueKey = $csrf->getTokenValueKey();

        return $this->container->get('View')->respond(
            $response,
            'home.twig',
            [
                'name'   => 'Jim',
                'csrf'   => [
                    'keys' => [
                        'name'  => $nameKey,
                        'value' => $valueKey
                    ],
                    'name'  => $request->getAttribute($nameKey),
                    'value' => $request->getAttribute($valueKey)
                ],
                'form' => (array) $request->getParsedBody()
            ]
        );
    }
}
