<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

/**
 * Load environtment variables from .env file
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');

$dotenv->load();
$dotenv->required('APP_ENV');
