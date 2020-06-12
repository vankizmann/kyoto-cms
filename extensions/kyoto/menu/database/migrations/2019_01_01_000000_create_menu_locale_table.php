<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLocaleTable extends Migration
{
    public function up()
    {
        Schema::create('menu_locales', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->uuid('foreign_id')
                ->nullable();

            $table->string('locale')
                ->default('');

            $table->string('title')
                ->nullable();

            $table->string('slug')
                ->nullable();

            $table->string('path')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_locales');
    }

}
