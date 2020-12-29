<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationTable extends Migration
{
    public function up()
    {
        Schema::create('translations', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->integer('state')
                ->default(0);

            $table->text('source')
                ->nullable();

            $table->text('target')
                ->nullable();

            $table->string('package')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('translations');
    }

}
