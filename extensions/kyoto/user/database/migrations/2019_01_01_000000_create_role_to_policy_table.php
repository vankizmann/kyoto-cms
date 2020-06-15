<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleToPolicyTable extends Migration
{
    public function up()
    {
        Schema::create('role_to_policy', function(Blueprint $table) {

            $table->uuid('role_id');
            $table->uuid('policy_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_to_policy');
    }

}
