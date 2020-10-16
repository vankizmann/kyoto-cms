<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function(Blueprint $table) {

            $table->uuid('id')
                ->primary();

            $table->string('title')
                ->default('');

            $table->string('content')
                ->nullable();

            $table->uuid('guard_id')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }

}
