<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('version');
            $table->unsignedBigInteger('supplierId');
            $table->foreign('supplierId')->references('id')->on('supplier');
            $table->unsignedBigInteger('conditionId');
            $table->foreign('conditionId')->references('id')->on('condition');
            $table->string('smartnet');
            $table->string('currency');
            $table->decimal('cost', 10, 2);
            $table->date('validate_from');
            $table->date('validate_to');
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('quotation');
    }
}
