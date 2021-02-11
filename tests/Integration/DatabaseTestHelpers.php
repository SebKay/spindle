<?php

namespace Tests\Integration;

use App\Database;
use App\Models\User;

class DatabaseTestHelpers
{
    public $db;
    public $faker;

    public function __construct(Database $db)
    {
        $this->db    = $db;
        $this->faker = \Faker\Factory::create();
    }

    /**
     * Create some fake users
     */
    public function createDummyUsers(int $amount = 1)
    {
        for ($i = 0; $i < $amount; $i++) {
            User::create([
                'email'      => $this->faker->email,
                'password'   => $this->faker->password,
                'first_name' => $this->faker->firstName,
                'last_name'  => $this->faker->lastName,
            ]);
        }
    }

    /**
     * Create fake data for tables
     */
    public function createDummyData()
    {
        $this->createDummyUsers();
    }
}
