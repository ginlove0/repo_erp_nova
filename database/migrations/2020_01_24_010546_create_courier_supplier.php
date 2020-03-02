<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("supplierId");
            $table->foreign("supplierId")->references('id')->on('supplier');
            $table->string('courier');
            $table->string('shippingAccount')->nullable();
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
        Schema::dropIfExists('courier_supplier');
    }
}
