<?php

namespace Tests\Unit;

use App\App;

class AppTest extends Test
{
    /**
     * @testdox It returns a 200 response when handling a valid request
     */
    public function test_returns_200_on_valid_request()
    {
        $request  = $this->createRequest('GET', '/');
        $app      = new App;
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @testdox It returns a 400 response when handling an invalid request
     */
    public function test_returns_400_on_an_invalid_request()
    {
        $request  = $this->createRequest('GET', '/cqwfewfvewrwer');
        $app      = new App;
        $response = $app->handle($request);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @testdox It returns a response when handling a request
     */
    public function test_returns_a_response()
    {
        $request = $this->createRequest('GET', '/');
        $app     = new App;

        $this->assertInstanceOf(\Psr\Http\Message\ResponseInterface::class, $app->handle($request));
    }
}
