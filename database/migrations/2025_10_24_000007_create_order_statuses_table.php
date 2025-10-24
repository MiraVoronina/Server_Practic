<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('order_statuses')) {
            Schema::create('order_statuses', function (Blueprint $table) {
                $table->id('IDStatus');
                $table->string('OrderStatusName', 100)->unique();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
