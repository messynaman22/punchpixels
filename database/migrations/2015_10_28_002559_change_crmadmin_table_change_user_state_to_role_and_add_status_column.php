<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCrmadminTableChangeUserStateToRoleAndAddStatusColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('crm_admins', function(Blueprint $table)
		{
			$table->string("status",100)->nullable();
            $table->dropColumn('user_state');
            $table->string('role', 50);
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
            $table->dropColumn("role");
            $table->integer("user_state");
            $table->dropColumn('status');

		});

	}

}
