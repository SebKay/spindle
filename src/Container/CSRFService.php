<?php

namespace App\Container;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Csrf\Guard;

class CSRFService extends Service
{
    public static function name(): string
    {
        return 'csrf';
    }

    public function config(): Guard
    {
        $guard = new Guard($this->app->slim()->getResponseFactory());

        $guard->setFailureHandler(function (
            ServerRequestInterface $request,
            RequestHandlerInterface $handler
        ): ResponseInterface {
            $status_code    = 400;
            $response       = $this->app->slim()
                ->getResponseFactory()
                ->createResponse()
                ->withStatus($status_code);

            return $this->container
                ->get('view')
                ->respond($response, 'layouts/http-error.twig', [
                    'code'        => $status_code,
                    'description' => 'There Was An Error',
                ]);
        });

        return $guard;
    }
}
