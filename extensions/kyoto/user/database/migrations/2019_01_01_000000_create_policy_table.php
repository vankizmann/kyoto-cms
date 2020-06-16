<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePolicyTable extends Migration
{
    public function up()
    {
        Schema::create('policies', function(Blueprint $table) {

            $table->uuid('id');

            $table->string('title')
                ->default('');

            $table->string('type')
                ->default('');

            $table->string('action')
                ->default('');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('policies');
    }

}
