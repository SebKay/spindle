<?php

namespace App\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        if (!$this->db->manager->schema()->hasTable('users')) {
            $this->db->manager->schema()->create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('email');
                $table->string('password');
                $table->string('first_name');
                $table->string('last_name');
                $table->timestamps();
            });
        }
    }
}
