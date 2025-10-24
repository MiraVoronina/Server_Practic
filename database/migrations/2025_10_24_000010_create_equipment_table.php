<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('equipment')) {
            Schema::create('equipment', function (Blueprint $table) {
                $table->id('IDEquipment');
                $table->foreignId('IDTypeOfEquipment')->constrained('type_of_equipment', 'IDTypeOfEquipment');
                $table->foreignId('IDBrand')->constrained('brands', 'IDBrand');
                $table->string('SerialNumber', 100)->nullable();
                $table->string('EquipmentName', 150);
                $table->string('Description', 255)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
