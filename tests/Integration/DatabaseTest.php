<?php

namespace Tests\Integration;

use App\Database;
use App\Models\User;

class DatabaseTest extends IntegrationTest
{
    /**
     * @var Database
     */
    protected $database;

    /**
     * @var DatabaseHe
     */
    protected $DatabaseTestHelpers;

    public function setUp(): void
    {
        parent::setUp();

        $this->database         = new Database();
        $this->database_helpers = new DatabaseTestHelpers($this->database);
    }

    /**
     * @testdox It creates migration tables
     */
    public function test_creates_migratable_tables()
    {
        $this->database->migrateTables();

        $this->assertTrue($this->database->db->schema()->hasTable('users'));
    }

    /**
     * @testdox It creates dummy users
     */
    public function test_creates_dummy_users()
    {
        $this->database->migrateTables();
        $this->database_helpers->createDummyUsers(3);

        $this->assertEquals(3, User::count());
    }
}
