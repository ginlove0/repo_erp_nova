<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();

            $table->enum("contactType",["Gov", "Corp", "Broker", "Individual"])->default('Individual');
            $table->enum("pricingLevel",["1", "2", "3", "4","5"])->default('5');

            $table->longText('ipsPolicy')->nullable();
            $table->longText('warrantyPolicy')->nullable();

            $table->longText('ipsTerm')->nullable();
            $table->longText('customerTerm')->nullable();
            $table->string('VAT')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier');
    }
}
