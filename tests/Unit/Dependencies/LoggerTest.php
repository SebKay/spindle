<?php

namespace Tests\Unit\Dependencies;

use App\Dependencies\Logger;
use Tests\Unit\UnitTest;

class LoggerTest extends UnitTest
{
    /**
     * @var Logger
     */
    protected $logger;

    protected $log_path;

    public function setUp(): void
    {
        parent::setUp();

        $this->log_path = __DIR__ . '/../../../logs/tests.log';
        $this->logger   = new Logger($this->log_path);
    }

    protected function deleteLogFile()
    {
        if (\file_exists($this->log_path)) {
            \unlink($this->log_path);
        }
    }

    /**
     * @testdox It can log
     */
    public function test_logging_works()
    {
        $message = 'A log message';

        $this->logger->log(200, $message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log a debug
     */
    public function test_debug_logging_works()
    {
        $message = 'A debug message';

        $this->logger->debug($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log info
     */
    public function test_info_logging_works()
    {
        $message = 'A info message';

        $this->logger->info($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log a notice
     */
    public function test_notice_logging_works()
    {
        $message = 'A notice message';

        $this->logger->notice($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log a warning
     */
    public function test_warning_logging_works()
    {
        $message = 'A warning message';

        $this->logger->warning($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log an error
     */
    public function test_error_logging_works()
    {
        $message = 'An error message';

        $this->logger->error($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log critical
     */
    public function test_critical_logging_works()
    {
        $message = 'A critical message';

        $this->logger->critical($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log an alert
     */
    public function test_alert_logging_works()
    {
        $message = 'An alert message';

        $this->logger->alert($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    /**
     * @testdox It can log an emergency
     */
    public function test_emergency_logging_works()
    {
        $message = 'An emergency message';

        $this->logger->emergency($message);

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString($message, $log_file);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $this->deleteLogFile();
    }
}
