<?php

namespace Tests\Unit\Dependencies;

use App\Dependencies\Logger;
use Tests\Unit\UnitTest;

class LoggerTest extends UnitTest
{
    protected $logger;
    protected $log_path;

    public function setUp(): void
    {
        parent::setUp();

        $this->log_path = __DIR__ . '/../../../logs/tests.log';
        $this->logger = new Logger($this->log_path);

        //---- Delete log file before every test
        if (\file_exists($this->log_path)) {
            \unlink($this->log_path);
        }
    }

    /**
     * @testdox It can log a debug
     */
    public function test_it_debug_logging_works()
    {
        $this->logger->debug('A debug message');

        $log_file = \file_get_contents($this->log_path);

        $this->assertStringContainsString('A debug message', $log_file);
    }
}
