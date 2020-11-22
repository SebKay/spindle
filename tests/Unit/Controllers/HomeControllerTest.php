<?php

namespace Tests\Unit\Controllers;

use App\App;
use Psr\Http\Message\UriInterface;
use Slim\Factory\ServerRequestCreatorFactory;
use Tests\Unit\Test;

class HomeControllerTest extends Test
{
    /**
     * @testdox It returns a 200 response with GET on the index method
     */
    public function test_index_returns_200_on_valid_request()
    {
        $request  = $this->createRequest('GET', '/');
        $app      = new App;
        $response = $app->handle($request);

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @testdox It returns a 400 response with CSRF data
     */
    public function test_update_returns_400_without_csrf()
    {
        $request  = $this->createRequest('POST', '/');
        $app      = new App;
        $response = $app->handle($request);

        $this->assertEquals(400, $response->getStatusCode());
    }
}
