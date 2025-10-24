<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfEquipmentTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('type_of_equipment')) {
            Schema::create('type_of_equipment', function (Blueprint $table) {
                $table->id('IDTypeOfEquipment');
                $table->string('TypeName', 100);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('type_of_equipment');
    }
}
