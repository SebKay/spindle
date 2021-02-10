<?php

namespace Tests\Integration;

use PHPUnit\Framework\TestCase;
use Tests\ServerTestTrait;

abstract class IntegrationTest extends TestCase
{
    use ServerTestTrait;
    
    public function setUp(): void
    {
        parent::setUp();
    }
}
