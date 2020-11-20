<?php

namespace App\Handlers;

use DI\Container;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpNotImplementedException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Handlers\ErrorHandler;
use Exception;
use Throwable;
use Slim\Interfaces\CallableResolverInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;

class HttpErrorHandler extends ErrorHandler
{
    public const BAD_REQUEST             = 'BAD_REQUEST';
    public const INSUFFICIENT_PRIVILEGES = 'INSUFFICIENT_PRIVILEGES';
    public const NOT_ALLOWED             = 'NOT_ALLOWED';
    public const NOT_IMPLEMENTED         = 'NOT_IMPLEMENTED';
    public const RESOURCE_NOT_FOUND      = 'RESOURCE_NOT_FOUND';
    public const SERVER_ERROR            = 'SERVER_ERROR';
    public const UNAUTHENTICATED         = 'UNAUTHENTICATED';

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container                 $container
     * @param CallableResolverInterface $callableResolver
     * @param ResponseFactoryInterface  $responseFactory
     * @param LoggerInterface|null      $logger
     */
    public function __construct(
        Container $container,
        CallableResolverInterface $callableResolver,
        ResponseFactoryInterface $responseFactory,
        ?LoggerInterface $logger = null
    ) {
        $this->container           = $container;
        $this->callableResolver    = $callableResolver;
        $this->responseFactory     = $responseFactory;
        $this->logger              = $logger ?: $this->getDefaultLogger();
        $this->displayErrorDetails = false;
        $this->logErrors           = false;
        $this->logErrorDetails     = false;
    }

    /**
     * Handle the request
     *
     * @return ResponseInterface
     * @codeCoverageIgnore
     */
    protected function respond(): ResponseInterface
    {
        $exception   = $this->exception;
        $statusCode  = 500;
        $type        = self::SERVER_ERROR;
        $description = 'An internal error has occurred while processing your request.';

        if ($exception instanceof HttpException) {
            $statusCode  = (int) $exception->getCode();
            $description = $exception->getMessage();

            if ($exception instanceof HttpNotFoundException) {
                $type = self::RESOURCE_NOT_FOUND;
            } elseif ($exception instanceof HttpMethodNotAllowedException) {
                $type = self::NOT_ALLOWED;
            } elseif ($exception instanceof HttpUnauthorizedException) {
                $type = self::UNAUTHENTICATED;
            } elseif ($exception instanceof HttpForbiddenException) {
                $type = self::UNAUTHENTICATED;
            } elseif ($exception instanceof HttpBadRequestException) {
                $type = self::BAD_REQUEST;
            } elseif ($exception instanceof HttpNotImplementedException) {
                $type = self::NOT_IMPLEMENTED;
            }
        }

        if (
            !($exception instanceof HttpException)
            && ($exception instanceof Exception || $exception instanceof Throwable)
            && $this->displayErrorDetails
        ) {
            $description = $exception->getMessage();
        }

        $error = [
            'statusCode' => $statusCode,
            'error'      => [
                'type'        => $type,
                'description' => $description,
            ],
        ];

        $response = $this->responseFactory->createResponse($statusCode);
        // $response->getBody()->write(json_encode($error, JSON_PRETTY_PRINT));

        return $this->container->get('View')->respond(
            $response,
            'http-error.twig',
            [
                'code'        => $statusCode,
                'description' => $description,
            ]
        );
    }
}
