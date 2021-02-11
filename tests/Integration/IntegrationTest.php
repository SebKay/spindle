<?php

namespace Tests\Integration;

use App\App;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTest extends TestCase
{
    use ServerTestTrait;

    /**
     * @var App
     */
    protected $app;

    public function setUp(): void
    {
        parent::setUp();

        $this->app = new App;
    }
}
