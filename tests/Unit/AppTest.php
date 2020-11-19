<?php

namespace Tests\Unit\Middleware;

use App\App;
use Tests\ServerTestTrait;
use Tests\Unit\Test;

class AppTest extends Test
{
    use ServerTestTrait;

    /**
     * @var App
     */
    protected $app;

    public function setUp(): void
    {
        $this->app = new App;
    }

    /**
     * @testdox It returns a valid response when handling a request
     */
    public function test_it_can_handle_a_request()
    {
        $request = $this->createRequest('GET', '/');

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $this->app->handle($request));
    }
}
