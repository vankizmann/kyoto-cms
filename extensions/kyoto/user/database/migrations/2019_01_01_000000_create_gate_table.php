<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGateTable extends Migration
{
    public function up()
    {
        Schema::create('gates', function(Blueprint $table) {

            $table->uuid('id');

            $table->string('title')
                ->default('');

            $table->string('description')
                ->default('');

            $table->uuid('parent_id')
                ->nullable();

            $table->integer('left')
                ->nullable();

            $table->integer('right')
                ->nullable();

            $table->integer('depth')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gates');
    }

}
