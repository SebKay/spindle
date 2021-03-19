<?php
/**
 * Set container services
 */

use App\Container\CSRFService;
use App\Container\ErrorRendererHTMLService;
use App\Container\LoggerService;
use App\Container\ViewService;

return [
    LoggerService::class,
    ErrorRendererHTMLService::class,
    CSRFService::class,
    ViewService::class
];
