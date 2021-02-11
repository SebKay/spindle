<?php

namespace Tests\Integration;

use App\Database;
use App\Models\User;

class DatabaseTestHelpers
{
    public $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Create some fake users
     */
    public function createDummyUsers()
    {
        User::create([
            'email'      => 'test@123.com',
            'password'   => '12345',
            'first_name' => 'Jim',
            'last_name'  => 'Gordon',
        ]);
    }

    /**
     * Create fake data for tables
     */
    public function createDummyData()
    {
        $this->createDummyUsers();
    }
}
