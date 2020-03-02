<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingMethodToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            //
            $table->enum("shipping_method", ["STANDARD", "EXPRESS"])->default('STANDARD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            //
            $table->dropColumn('shipping_method');
        });
    }
}
