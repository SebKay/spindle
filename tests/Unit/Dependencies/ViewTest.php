<?php

namespace Tests\Unit\Middleware;

use App\App;
use App\Dependencies\View;
use Tests\Unit\UnitTest;

class ViewTest extends UnitTest
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
     * @testdox It returns a string when rendering
     */
    public function test_it_renders_a_string()
    {
        $view = new View(
            __DIR__ . '/../../../resources/views',
            ''
        );

        $this->assertIsString($view->render('home.twig'));
    }

    /**
     * @testdox It returns a response when responding
     */
    public function test_it_responds_with_a_response()
    {
        $request = $this->createRequest('GET', '/');

        $this->assertInstanceOf('\Psr\Http\Message\ResponseInterface', $this->app->handle($request));
    }
}
