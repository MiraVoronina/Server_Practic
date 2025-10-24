<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id('IDOrder');
                $table->foreignId('IDUser')->constrained('users', 'IDUser');
                $table->foreignId('IDEquipment')->constrained('equipment', 'IDEquipment');
                $table->foreignId('IDStatus')->constrained('order_statuses', 'IDStatus');
                $table->string('OrderNumber', 32)->unique();
                $table->string('TrackingNumber', 64)->nullable();
                $table->text('Description')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
