<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('brands')) {
            Schema::create('brands', function (Blueprint $table) {
                $table->id('IDBrand');
                $table->string('BrandName', 100)->unique();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
