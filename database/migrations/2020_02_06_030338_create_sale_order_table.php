<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplierId');
            $table->foreign('supplierId')->references('id')->on('supplier');

            $table->unsignedBigInteger('representativeId')->nullable();
            $table->foreign('representativeId')->references('id')->on('representative');

            $table->unsignedBigInteger('supplierEmailId');
            $table->foreign('supplierEmailId')->references('id')->on('supplier_email');

            $table->unsignedBigInteger('billingAddressId');
            $table->foreign('billingAddressId')->references('id')->on('supplieraddress');


            $table->unsignedBigInteger('shippingAddressId');
            $table->foreign('shippingAddressId')->references('id')->on('supplieraddress');


//            $table->enum('shippingMethod',["EXPRESS", "STANDARD", "OVERNIGHT"])->default('STANDARD');
            $table->string('shippingMethod')->default('STANDARD');
//            $table->longText('')

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
        Schema::dropIfExists('sale_order');
    }
}
