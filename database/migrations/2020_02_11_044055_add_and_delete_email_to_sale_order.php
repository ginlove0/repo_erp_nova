<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndDeleteEmailToSaleOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sale_order', function (Blueprint $table) {
            //remove the old supplier email id
            $table->dropForeign(['supplierEmailId']);
            $table->dropColumn('supplierEmailId');

            $table->unsignedBigInteger('supplierInvoiceEmailId');
            $table->foreign('supplierInvoiceEmailId')->references('id')->on('supplier_email');

            $table->unsignedBigInteger('supplierTrackingEmailId');
            $table->foreign('supplierTrackingEmailId')->references('id')->on('supplier_email');
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
            $table->dropForeign(['supplierTrackingEmailId']);
            $table->dropForeign(['supplierInvoiceEmailId']);
        });
    }
}
