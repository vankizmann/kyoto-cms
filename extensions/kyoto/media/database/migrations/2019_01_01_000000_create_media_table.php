<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('medias', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->string('title')
                ->default('');

            $table->string('description')
                ->nullable();

            $table->string('source')
                ->nullable();

            $table->string('file')
                ->default('');

            $table->string('type')
                ->nullable();

            $table->uuid('guard_id')
                ->nullable();

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
        Schema::dropIfExists('medias');
    }

}
