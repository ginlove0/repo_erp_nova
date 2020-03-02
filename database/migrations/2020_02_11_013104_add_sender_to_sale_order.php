<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSenderToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('sender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            //
            $table->dropForeign(['sender_id']);
        });
    }
}
