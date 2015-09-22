<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrmAdminsTable extends Migration {

	
	public function up()
	{
		Schema::create('crm_admins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("token",45)->nullable();
			$table->string("username");
			$table->string("password");
			$table->string("email")->unique();
			$table->integer("user_state",1);
			$table->timestamps();

		});
	}
	
	public function down()
	{
		Schema::drop('crm_admins');
	}

}
