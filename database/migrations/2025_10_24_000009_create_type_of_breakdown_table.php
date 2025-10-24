<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfBreakdownTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('type_of_breakdown')) {
            Schema::create('type_of_breakdown', function (Blueprint $table) {
                $table->id('IDTypeOfBreakdown');
                $table->string('BreakdownName', 150);
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('type_of_breakdown');
    }
}
