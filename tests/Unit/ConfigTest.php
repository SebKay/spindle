<?php

namespace Tests\Unit;

use App\Config;

class ConfigTest extends UnitTest
{
    /**
     * @testdox set() returns and empty array when the file doesn't exist
     */
    public function test_invalid_file_return_empty_array()
    {
        $set = Config::set('test.php');

        $this->assertIsArray($set);
        $this->assertEmpty($set);
    }
}
