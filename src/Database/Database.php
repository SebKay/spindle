<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as manager;

class Database
{
    /**
     * @var manager
     */
    public $manager;

    public function __construct()
    {
        $this->manager = new manager();

        $this->setup();
    }

    /**
     * Create connection and make global
     */
    protected function setup(): void
    {
        $this->manager->addConnection([
            'driver'   => ($_ENV['DB_DRIVER'] ?? null),
            'host'     => ($_ENV['DB_HOST'] ?? null),
            'database' => ($_ENV['DB_DATABASE'] ?? null),
            'username' => ($_ENV['DB_USERNAME'] ?? null),
            'password' => ($_ENV['DB_PASSWORD'] ?? null),
            'port'     => ($_ENV['DB_PORT'] ?? null),
        ], 'default');

        $this->manager->setAsGlobal();

        $this->manager->bootEloquent();
    }
}
