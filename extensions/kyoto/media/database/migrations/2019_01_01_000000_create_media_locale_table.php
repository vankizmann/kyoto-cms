<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaLocaleTable extends Migration
{
    public function up()
    {
        Schema::create('media_locales', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->uuid('foreign_id')
                ->nullable();

            $table->string('locale')
                ->default('');

            $table->string('title')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->text('copyright')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_locales');
    }

}
