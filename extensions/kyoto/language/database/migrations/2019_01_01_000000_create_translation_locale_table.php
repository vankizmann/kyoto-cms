<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationLocaleTable extends Migration
{
    public function up()
    {
        Schema::create('translation_locales', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->uuid('foreign_id')
                ->nullable();

            $table->string('locale')
                ->default('');

            $table->text('target')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('translation_locales');
    }

}
