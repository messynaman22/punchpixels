<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailDetails extends Migration {

	
	public function up()
	{
		Schema::create('email_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("to_from");
			$table->string("type",50);
			$table->string("subject");
			$table->text("message");
			$table->tinyInt("include_data");
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('email_details');
	}

}
