<?php

namespace App;

use Illuminate\Database\Capsule\Manager as DB;

class Database
{
    /**
     * @var DB
     */
    public $db;

    public function __construct()
    {
        $this->db = new DB();

        $this->setup();
    }

    /**
     * Create connection and make global
     */
    protected function setup(): void
    {
        $this->db->addConnection([
            'driver'   => ($_ENV['DB_DRIVER'] ?? null),
            'host'     => ($_ENV['DB_HOST'] ?? null),
            'database' => ($_ENV['DB_DATABASE'] ?? null),
            'username' => ($_ENV['DB_USERNAME'] ?? null),
            'password' => ($_ENV['DB_PASSWORD'] ?? null),
            'port'     => ($_ENV['DB_PORT'] ?? null),
        ], 'default');

        $this->db->setAsGlobal();

        $this->db->bootEloquent();
    }

    /**
     * Create the "users" table
     */
    protected function createUsersTable(): void
    {
        if (!$this->db->schema()->hasTable('users')) {
            $this->db->schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('email');
                $table->string('password');
                $table->string('first_name');
                $table->string('last_name');
                $table->timestamps();
            });
        }
    }

    /**
     * Create all tables
     * * Will skip tables if they already exist
     */
    public function migrateTables(): void
    {
        $this->createUsersTable();
    }
}
