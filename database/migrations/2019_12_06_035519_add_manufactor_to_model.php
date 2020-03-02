<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddManufactorToModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('model', function (Blueprint $table) {

            $table->foreign('manufactorId')->references('id')->on('manufactor');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('model', function (Blueprint $table) {
            //
            $table->dropForeign(['manufactorId']);
       


        });
    }
}
