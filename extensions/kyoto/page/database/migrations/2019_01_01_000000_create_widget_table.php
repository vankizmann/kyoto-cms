<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWidgetTable extends Migration
{
    public function up()
    {
        Schema::create('widgets', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->uuid('source_id')
                ->nullable();

            $table->integer('state')
                ->default(1);

            $table->string('type')
                ->default('');

            $table->text('data')
                ->nullable();

            $table->integer('sequence')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('widgets');
    }

}
