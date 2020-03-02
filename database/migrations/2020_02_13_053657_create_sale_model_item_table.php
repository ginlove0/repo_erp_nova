<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleModelItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_model_item', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('sn_out_of_stock');
            $table->foreign('sn_out_of_stock')->references('id')->on('item');

            $table->unsignedBigInteger('sale_order_model_id');
            $table->foreign('sale_order_model_id')->references('id')->on('sale_order_model');

            $table->unsignedBigInteger('sn_display_client');
            $table->foreign('sn_display_client')->references('id')->on('item');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_model_item');
    }
}
