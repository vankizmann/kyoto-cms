<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function(Blueprint $table) {

            $table->uuid('id');

            $table->string('title')
                ->default('');

            $table->string('description')
                ->default('');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }

}
