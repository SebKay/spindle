<?php
/**
 * Set container services
 */

use App\Services\CSRFService;
use App\Services\ErrorRendererHTMLService;
use App\Services\LoggerService;
use App\Services\ViewService;

return [
    LoggerService::class,
    ErrorRendererHTMLService::class,
    CSRFService::class,
    ViewService::class
];
