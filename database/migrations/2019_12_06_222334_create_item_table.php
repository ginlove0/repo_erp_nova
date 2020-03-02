<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('addedBy');
            $table->bigInteger('supplierId')->unsigned()->nullable();

            // Model
            $table->bigInteger('modelId')->unsigned();
            $table->foreign('modelId')->references('id')->on('model');



            $table->string('serialNumber')->unique()->nullable();

            // cost could be vary so it can be null
            $table->decimal('price', 20,2)->nullable();

            $table->string('note')->nullable();
            $table->string('extra')->nullable();

//            những item không có SN sẽ quản lý bằng Qty
            $table->integer('quantity')->nullable();


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
        Schema::dropIfExists('item');
    }
}
