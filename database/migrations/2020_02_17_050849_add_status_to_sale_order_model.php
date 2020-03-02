<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToSaleOrderModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order_model', function (Blueprint $table) {
            //
            $table->enum('status', ["complete", "confirm", "partial", "pending", "invoice", "cancel"])->default('pending');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_order_model', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
