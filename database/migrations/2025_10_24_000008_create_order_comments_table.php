<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCommentsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_comments')) {
            Schema::create('order_comments', function (Blueprint $table) {
                $table->id('IDComment');
                $table->foreignId('IDOrder')->constrained('orders', 'IDOrder')->onDelete('cascade');
                $table->foreignId('IDUser')->constrained('users', 'IDUser')->onDelete('cascade');
                $table->text('CommentText');
                $table->timestamp('CreatedAt')->useCurrent();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('order_comments');
    }
}
