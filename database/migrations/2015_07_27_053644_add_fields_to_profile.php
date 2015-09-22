<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProfile extends Migration {

	
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{			
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('id')->on('profiles')->onDelete('cascade');
		});
	}

	
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropForeign("orders_user_id_foreign");
		});
	}

}
