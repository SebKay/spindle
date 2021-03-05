<?php

namespace Tests\Integration\Database;

use App\Models\User;
use Tests\Integration\IntegrationTest;

class DatabaseTest extends IntegrationTest
{
    /**
     * @testdox It creates migration tables
     */
    public function test_creates_migratable_tables()
    {
        $this->assertTrue($this->db->manager->schema()->hasTable('users'));
    }

    /**
     * @testdox It creates dummy users
     */
    public function test_creates_dummy_data()
    {
        $this->assertEquals(3, User::count());
    }
}
