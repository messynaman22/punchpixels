<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContractAgreementSectionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contract_agreement_section', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string("section_name")->unique();
			$table->string("section_description");
			$table->text("content");
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
		Schema::drop('ContractAgreementSection');
	}

}
