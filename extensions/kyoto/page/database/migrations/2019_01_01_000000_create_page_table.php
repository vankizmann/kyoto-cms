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

            $table->integer('state')
                ->default(1);

            $table->integer('hide')
                ->default(0);

            $table->string('title')
                ->default('');

            $table->string('slug')
                ->nullable();

            $table->text('content')
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
