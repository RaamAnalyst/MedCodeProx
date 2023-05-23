<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIcdPcsOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('icd_pcs_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8519672')->references('id')->on('users');
        });
    }
}
