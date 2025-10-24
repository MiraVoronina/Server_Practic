<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('user_roles')) {
            Schema::create('user_roles', function (Blueprint $table) {
                $table->id('IDUserRole');
                $table->string('RoleName', 50)->unique();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('user_roles');
    }
}
