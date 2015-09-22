<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned()->unique('user_id', 'user_profiles_user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->string('fname', 60)->nullable()->comment('First Name');
            $table->string('mname', 60)->nullable()->comment('Middle Name');
            $table->string('lname', 60)->nullable()->comment('Last Name');

            $table->string('paddress', 60)->nullable()->comment('Physical Address');
            $table->string('city', 40)->nullable()->comment('City');
            $table->string('state', 40)->nullable()->comment('State');
            $table->string('country', 40)->nullable()->comment('Country');
            $table->string('zip', 20)->nullable()->comment('Zip Code');

            $table->tinyInteger('sameadd')->default(0)->comment('Use the Physical Address as Mailing Address');
            $table->string('mpaddress', 60)->nullable()->comment('Mailing Address');
            $table->string('mcity', 40)->nullable()->comment('City');
            $table->string('mstate', 40)->nullable()->comment('State');
            $table->string('mzip', 20)->nullable()->comment('Zip Code');

            $table->string('hno', 30)->nullable()->comment('Home Number');
            $table->string('mno', 30)->nullable()->comment('Mobile Number');

            $table->tinyInteger('ml')->default(0)->comment('Have you been in the Military?');
            $table->string('hau', 30)->nullable()->comment('How Did You Hear About Us');
            $table->string('in', 30)->nullable()->comment('What are you interested In');
            $table->string('btc', 30)->nullable()->comment('Best time to contact you?');

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
        Schema::drop('profiles');
    }
}
