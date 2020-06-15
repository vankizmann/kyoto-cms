<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    public function up()
    {
        Schema::create('languages', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->integer('state')
                ->default(0);

            $table->integer('hide')
                ->default(0);

            $table->string('language')
                ->default('');

            $table->string('country')
                ->default('');

            $table->string('locale')
                ->default('');

            $table->string('plate')
                ->default('');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }

}
