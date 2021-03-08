<?php

namespace App\Database;

use App\Database\Database;
use App\Database\Migrations\CreateUsersTable;
use App\Models\User;

class DatabaseHelpers
{
    /**
     * @var Database
     */
    public $db;

    /**
     * @var \Faker\Generator
     */
    public $faker;

    public function __construct(Database $db)
    {
        $this->db    = $db;
        $this->faker = \Faker\Factory::create();
    }

    public function migrateUsersTable(): void
    {
        (new CreateUsersTable($this->db))->up();
    }

    public function migrateTables(): void
    {
        $this->migrateUsersTable();
    }

    public function createDummyUsers(int $amount = 3): void
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

    public function createDummyData(): void
    {
        $this->createDummyUsers();
    }
}
