<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserToRoleTable extends Migration
{
    public function up()
    {
        Schema::create('user_to_role', function(Blueprint $table) {

            $table->uuid('user_id');
            $table->uuid('role_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_to_role');
    }

}
