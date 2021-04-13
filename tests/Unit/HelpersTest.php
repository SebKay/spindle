<?php

namespace Tests\Unit;

use App\Helpers;

class HelpersTest extends UnitTest
{
    public function test_it_gets_all_major_http_status_codes()
    {
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(200));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(301));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(302));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(400));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(403));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(404));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(500));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(502));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(503));
        $this->assertNotEmpty(Helpers::getHttpStatusMessage(504));
    }
}
