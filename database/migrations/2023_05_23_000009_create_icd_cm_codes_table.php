<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIcdCmCodesTable extends Migration
{
    public function up()
    {
        Schema::create('icd_cm_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('code_title')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
