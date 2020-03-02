<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;
class AddWhlocationToSaleOrder extends Migration
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
            $table->unsignedBigInteger('whlocation_id');
            $table->foreign('whlocation_id')->references('id')->on('whlocation');

            $table->timestamp('required_date')->default(DB::raw('CURRENT_TIMESTAMP'));

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
            $table->dropForeign(['whlocation_id']);
            $table->dropColumn('whlocation_id');
            $table->dropColumn('required_date');
        });
    }
}
