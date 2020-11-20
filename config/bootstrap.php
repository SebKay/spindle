<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

/**
 * Load environtment variables from .env file
 */
Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
