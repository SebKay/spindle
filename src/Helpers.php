<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface;
use Slim\Csrf\Guard;

class Helpers
{
    /**
     * Generate array of CSRF data
     *
     * @param Guard $csrf_guard
     * @param ServerRequestInterface $request
     * @return array
     */
    public static function generateCSRFData(Guard $csrf_guard, ServerRequestInterface $request): array
    {
        $name_key  = $csrf_guard->getTokenNameKey();
        $value_key = $csrf_guard->getTokenValueKey();

        return [
            'keys' => [
                'name'  => $name_key,
                'value' => $value_key
            ],
            'name'  => $request->getAttribute($name_key),
            'value' => $request->getAttribute($value_key)
        ];
    }
}
