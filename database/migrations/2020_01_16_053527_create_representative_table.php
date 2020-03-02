<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentativeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representative', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('supplierId')->unsigned();
            $table->foreign('supplierId')->references('id')->on('supplier');
            $table->enum('salutation', ['Mr','Ms', 'Mrs', 'Other'])->default('Other');
            $table->string('fullName');
            $table->string('position')->nullable();
            $table->string('phoneNumber')->nullable();
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
        Schema::dropIfExists('representative');
    }
}
