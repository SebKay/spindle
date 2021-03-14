<?php

namespace Tests\Integration\Controllers;

use Tests\Integration\IntegrationTest;

class HomeControllerTest extends IntegrationTest
{
    /**
     * @testdox It returns a 200 response with GET on the index method
     */
    public function test_index_returns_200_on_valid_request()
    {
        $request = $this->createRequest('GET', '/');

        $this->assertEquals(200, $this->app->handle($request)->getStatusCode());
    }

    /**
     * @testdox It returns a 200 response with CSRF data
     */
    public function test_update_returns_200_with_csrf()
    {
        $get_request = $this->createRequest('GET', '/');
        $this->app->handle($get_request);

        $csrf_guard = $this->app->container()->injector()->get('csrf');

        $post_request = $this->createRequest('POST', '/')
            ->withAddedHeader('Content-Type', 'multipart/form-data')
            ->withParsedBody([
                $csrf_guard->getTokenNameKey()  => $csrf_guard->getTokenName(),
                $csrf_guard->getTokenValueKey() => $csrf_guard->getTokenValue(),
            ]);

        $this->assertEquals(200, $this->app->handle($post_request)->getStatusCode());
    }

    /**
     * @testdox It returns a 400 response without CSRF data
     */
    public function test_update_returns_400_without_csrf()
    {
        $request = $this->createRequest('POST', '/');

        $this->assertEquals(400, $this->app->handle($request)->getStatusCode());
    }
}
