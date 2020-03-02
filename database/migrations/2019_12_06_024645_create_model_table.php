<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('addedBy')->nullable();
            $table->unsignedBigInteger('manufactorId');
            $table->string('name')->unique();


            // model could have many other name
            $table->boolean('hasSerial')->default(true);
            $table->string('shortDescription')->nullable();
            $table->longText('longDescription')->nullable();
            $table->longText('note')->nullable();
            $table->string('logId')->nullable();
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
        Schema::dropIfExists('model');
    }
}
