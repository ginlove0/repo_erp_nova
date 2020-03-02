<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modelId');
            $table->foreign('modelId')->references('id')->on('model');
            $table->unsignedBigInteger('accessoriesId');
            $table->foreign('accessoriesId')->references('id')->on('model');
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
        Schema::dropIfExists('model_accessories');
    }
}
