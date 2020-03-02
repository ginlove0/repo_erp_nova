<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliernoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliernote', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->longText('internalNote')->nullable();
            $table->unsignedBigInteger('supplierId');
            $table->foreign('supplierId')->references('id')->on('supplier');
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
        Schema::dropIfExists('suppliernote');
    }
}
