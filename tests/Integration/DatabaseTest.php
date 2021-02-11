<?php

namespace Tests\Integration;

use App\App;
use App\Database;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;
use Tests\ServerTestTrait;

class DatabaseTest extends IntegrationTest
{
    /**
     * @var Database
     */
    protected $database;

    public function setUp(): void
    {
        parent::setUp();

        $this->database = new Database();
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
     * @testdox It creates dummy data
     */
    public function test_creates_dummy_data()
    {
        $this->database->migrateTables();
        $this->database->createDummyData();

        $this->assertNotNull(User::where('email', '=', 'test@123.com'));
    }
}
