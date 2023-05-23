<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcdPcsCodesTable extends Migration
{
    public function up()
    {
        Schema::create('icd_pcs_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pcs_codes')->nullable();
            $table->string('pcs_code_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
