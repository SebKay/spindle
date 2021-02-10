<?php

namespace Tests\Integration\Middleware;

use Tests\Integration\IntegrationTest;

class ViewTest extends IntegrationTest
{
    /**
     * @testdox It returns a response when responding
     */
    public function test_it_responds_with_a_response()
    {
        $request = $this->createRequest('GET', '/');

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $this->app->handle($request));
    }
}
