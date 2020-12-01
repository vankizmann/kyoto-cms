<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->string('title')
                ->default('');

            $table->string('content')
                ->nullable();

            $table->string('builder')
            ->nullable();

            $table->uuid('guard_id')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pages');
    }

}
