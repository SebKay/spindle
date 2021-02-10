<?php

namespace Tests\Integration;

use App\App;

class AppTest extends IntegrationTest
{
    /**
     * @var App
     */
    protected $app;

    public function setUp(): void
    {
        parent::setUp();

        $this->app = new App;
    }

    /**
     * @testdox It returns a 200 response when handling a valid request
     */
    public function test_returns_200_on_valid_request()
    {
        $request  = $this->createRequest('GET', '/');
        $response = $this->app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @testdox It returns a 400 response when handling an invalid request
     */
    public function test_returns_400_on_an_invalid_request()
    {
        $request  = $this->createRequest('GET', '/cqwfewfvewrwer');
        $response = $this->app->handle($request);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @testdox It returns a response when handling a request
     */
    public function test_returns_a_response()
    {
        $request = $this->createRequest('GET', '/');

        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $this->app->handle($request));
    }
}
