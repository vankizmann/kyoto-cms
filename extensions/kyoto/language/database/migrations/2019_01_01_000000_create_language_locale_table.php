<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageLocaleTable extends Migration
{
    public function up()
    {
        Schema::create('language_locales', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->uuid('foreign_id')
                ->nullable();

            $table->string('locale')
                ->default('');

            $table->string('country')
                ->nullable();

            $table->string('language')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('language_locales');
    }

}
