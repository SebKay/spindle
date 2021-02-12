<?php

namespace App\Controllers;

use App\Helpers;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{
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
        return $this->view->respond(
            $response,
            'layouts/home.twig',
            [
                'name'   => 'Jim',
                'csrf'   => Helpers::generateCSRFData($this->csrf, $request)
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
        return $this->view->respond(
            $response,
            'layouts/home.twig',
            [
                'name' => 'Jim',
                'csrf' => Helpers::generateCSRFData($this->csrf, $request),
                'form' => (array) $request->getParsedBody()
            ]
        );
    }
}
