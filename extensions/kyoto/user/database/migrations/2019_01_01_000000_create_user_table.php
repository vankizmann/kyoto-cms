<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {

            $table->uuid('id');

            $table->uuid('role_id')
                ->nullable();

            $table->uuid('gate_id')
                ->nullable();

            $table->integer('state')
                ->default(0);

            $table->string('name')
                ->unique();

            $table->string('email')
                ->unique();

            $table->string('password')
                ->default('');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }

}
