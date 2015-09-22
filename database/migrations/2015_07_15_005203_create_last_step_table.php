<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastStepTable extends Migration {


	public function up()
	{
		Schema::create('last_step', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('profiles')->onDelete('cascade');
			$table->string("driving_license_number");
			$table->string("driving_license_state",100);
			$table->string("social_security_number");
			$table->date("birthdate");
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('last_step');
	}

}
