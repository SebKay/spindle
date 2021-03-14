<?php

use App\Controllers\HomeController;
use Slim\Routing\RouteCollectorProxy;

/**
 * Home
 */
$this->slim->group('', function (RouteCollectorProxy $group) {
    $group->get('/', [HomeController::class, 'index'])->setName('home');
    $group->post('/', [HomeController::class, 'update']);
});
