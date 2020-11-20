<?php

require __DIR__ . '/../vendor/autoload.php';

/**
 * Load environtment variables from .env file
 */
Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
