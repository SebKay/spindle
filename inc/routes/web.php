<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$this->slim->get('/', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {
    var_dump($this->has('Test'));

    $response->getBody()->write('Hello world!' . $this->get('Test')->yas());
    
    return $response;
});
