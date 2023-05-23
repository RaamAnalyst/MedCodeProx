<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcdPcsOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('icd_pcs_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pcs_order_number')->nullable();
            $table->string('icd_pcs_code')->nullable();
            $table->string('pcs_category')->nullable();
            $table->string('pcs_short_desc')->nullable();
            $table->longText('pcs_long_desc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
