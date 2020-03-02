<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentsupplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplierId');
            $table->foreign('supplierId')->references('id')->on('supplier');
            $table->string('currency')->default('AUD');


            $table->string('bankName');
            $table->string('bankBranch');
            $table->string('BSB');
            $table->string('accountName');
            $table->string('accountNumber');
            $table->string('paypal')->nullable();



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
        Schema::dropIfExists('paymentsupplier');
    }
}
