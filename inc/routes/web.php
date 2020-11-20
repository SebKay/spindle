<?php

use App\Controllers\HomeController;

$this->slim->get('/', HomeController::class . ':index');
