<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('user_info')) {
            Schema::create('user_info', function (Blueprint $table) {
                $table->id('IDUserInfo');
                $table->foreignId('IDUser')->constrained('users', 'IDUser')->onDelete('cascade');
                $table->string('Name', 100);
                $table->string('Surname', 100);
                $table->string('Email', 255)->unique();
                $table->string('Phone', 11);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('user_info');
    }
}
