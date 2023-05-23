<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcdOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('icd_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_number')->nullable();
            $table->string('icd_cm')->nullable();
            $table->string('category')->nullable();
            $table->string('short_desc')->nullable();
            $table->longText('long_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
