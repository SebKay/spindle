<?php

namespace App\Database\Migrations;

use App\Database\Database;
use Illuminate\Database\Migrations\Migration as IlluminateMigration;

abstract class Migration extends IlluminateMigration
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
}
