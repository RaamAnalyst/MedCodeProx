<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIcdPcsCodesTable extends Migration
{
    public function up()
    {
        Schema::table('icd_pcs_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8519662')->references('id')->on('users');
        });
    }
}
