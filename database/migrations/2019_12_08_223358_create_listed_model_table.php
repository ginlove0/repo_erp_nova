<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListedModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listed_model', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('modelId')->unsigned();
            $table->foreign('modelId')->references('id')->on('model');
            $table->bigInteger('conditionId')->unsigned();
            $table->foreign('conditionId')->references('id')->on('condition');
            $table->string('websiteLink')->nullable();
            $table->string('fromWebsite');
            $table->decimal('listPrice',10,2);
            $table->decimal('shippingPrice', 10, 2)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('listed_model');
    }
}
