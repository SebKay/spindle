<?php

namespace Tests\Integration;

use App\App;
use App\Database\Database;
use App\Database\DatabaseHelpers;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTest extends TestCase
{
    use ServerTestTrait;

    /**
     * @var App
     */
    protected $app;

    /**
     * @var Database
     */
    protected $db;

    /**
     * @var DatabaseHelpers
     */
    protected $db_helpers;

    public function setUp(): void
    {
        parent::setUp();

        $this->app = new App;

        $this->db         = new Database();
        $this->db_helpers = new DatabaseHelpers($this->db);

        $this->db_helpers->migrateTables();
        $this->db_helpers->createDummyData();
    }

    public function tearDown(): void
    {
        $_SESSION = [];

        session_destroy();
    }
}
