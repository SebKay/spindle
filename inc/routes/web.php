<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$this->slim->get('/', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
    $response->getBody()->write($this->get('View')->render('home.twig', [
        'name' => 'Jim'
    ]));

    return $response;
});
