<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrderModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order_model', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('modelId');
            $table->foreign('modelId')->references('id')->on('model');

            $table->unsignedBigInteger('sale_order_id');
            $table->foreign('sale_order_id')->references('id')->on('sale_order');

            $table->unsignedBigInteger('conditionId');
            $table->foreign('conditionId')->references('id')->on('condition');

            $table->integer('qty');
            $table->decimal('price', 12,2);

            $table->longText('note')->nullable();


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
        Schema::dropIfExists('sale_order_model');
    }
}
