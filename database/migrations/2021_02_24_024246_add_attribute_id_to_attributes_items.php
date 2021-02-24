<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributeIdToAttributesItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attributes_items', function (Blueprint $table) {
            // $table->unsignedBigInteger('attribute_id');
            // $table->foreign('attribute_id')->references('id')->on('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attributes_items', function (Blueprint $table) {
            // $table->dropForeign(['attribute_id']);
            // $table->dropColumn(['attribute_id']);
        });
    }
}
