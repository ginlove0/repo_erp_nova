<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingChargeAndDiscountToSaleOrder extends Migration
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
            $table->decimal('discount', 10,2)->default(0);
            $table->decimal('shipping_charge', 20, 2)->default(0);
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
            $table->dropColumn('discount');
            $table->dropColumn('shipping_charge');

        });
    }
}
