<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCrmAdminsAddColumnLoginAttemps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('crm_admins', function(Blueprint $table)
		{
			$table->integer("login_attemps")->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('crm_admins', function(Blueprint $table)
		{
			$table->dropColumn('login_attemps');
		});
	}

}
