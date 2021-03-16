<?php

namespace App\Dependencies;

use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{
    protected $level;
    protected $logger;

    public function __construct(string $log_path = null)
    {
        $log_path = ($log_path ?: __DIR__ . '/../../logs/app.log');

        $this->logger = new MonologLogger('App');

        $this->logger->pushHandler(
            new StreamHandler($log_path)
        );
    }

    public function log($level, $message, array $context = [])
    {
        $this->logger->addRecord($level, $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->logger->debug($message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->logger->info($message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->logger->notice($message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->logger->warning($message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->logger->error($message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->logger->critical($message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->logger->alert($message, $context);
    }

    public function emergency($message, array $context = [])
    {
        $this->logger->emergency($message, $context);
    }
}
