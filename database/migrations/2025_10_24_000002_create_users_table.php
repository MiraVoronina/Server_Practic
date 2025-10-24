<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id('IDUser');
                $table->foreignId('IDUserRole')->constrained('user_roles', 'IDUserRole');
                $table->string('Login', 50)->unique();
                $table->string('Password', 255);
                $table->rememberToken();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
