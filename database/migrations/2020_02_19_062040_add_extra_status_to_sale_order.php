<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraStatusToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            $table->enum('shipped', ['full', 'partial'])->nullable();
            $table->enum('invoiced', ['full', 'partial'])->nullable();
            $table->enum('packed', ['full', 'partial'])->nullable();

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

            $table->dropColumn("shipped");
            $table->dropColumn("invoiced");
            $table->dropColumn("packed");

        });
    }
}
