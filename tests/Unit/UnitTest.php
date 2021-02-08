<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Tests\ServerTestTrait;

abstract class UnitTest extends TestCase
{
    use ServerTestTrait;
    
    public function setUp(): void
    {
        //
    }
}
