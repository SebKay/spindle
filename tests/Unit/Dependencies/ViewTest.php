<?php

namespace Tests\Unit\Middleware;

use App\Dependencies\View;
use Tests\Unit\UnitTest;

class ViewTest extends UnitTest
{
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
}
