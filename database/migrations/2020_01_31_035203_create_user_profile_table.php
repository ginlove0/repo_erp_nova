<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->unsignedBigInteger('usersId');
            $table->foreign('usersId')->references('id')->on('users');
            $table->string('name');
            $table->date('dob');
            $table->longText('address');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('phoneNumber');


            // emergency contact
            $table->string('emergencyContactName');
            $table->string('emergencyContactPhoneNumber');

            // Bank details
            $table->string('bankName');
            $table->string('bankBranch');
            $table->string('BSB');
            $table->string('accountName');
            $table->string('accountNumber');


            // super
            $table->string('fundName');
            $table->string('fundNumber');
            $table->string('usi');
            $table->string('accountSuperName');
            $table->string('membershipNumber');
            $table->string('tfn');



            // 
      
            
        
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
        Schema::dropIfExists('user_profile');
    }
}
