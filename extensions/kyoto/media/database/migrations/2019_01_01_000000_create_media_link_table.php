<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaLinkTable extends Migration
{
    public function up()
    {
        Schema::create('media_links', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->integer('sequence')
                ->nullable();

            $table->uuid('media_id')
                ->nullable();

            $table->uuid('foreign_id')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_links');
    }

}
