<?php
/**
 * Load environtment variables from .env file
 */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');

$dotenv->load();
$dotenv->required([
    'APP_ENV',
    'DB_DRIVER',
    'DB_HOST',
    'DB_DATABASE',
]);
