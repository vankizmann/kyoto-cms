<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageLocaleTable extends Migration
{
    public function up()
    {
        Schema::create('page_locales', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->uuid('foreign_id')
                ->nullable();

            $table->string('locale')
                ->default('');

            $table->string('title')
                ->nullable();

            $table->string('content')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('page_locales');
    }

}
