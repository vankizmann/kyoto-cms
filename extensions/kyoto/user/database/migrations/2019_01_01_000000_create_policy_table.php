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

            $table->string('class')
                ->default('')->nullable();

            $table->string('method')
                ->default('')->nullable();

            $table->string('module')
                ->default('')->nullable();

            $table->integer('depth')
                ->default(0)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('policies');
    }

}
