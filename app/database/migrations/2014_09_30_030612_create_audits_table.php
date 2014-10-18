<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audits', function($table) { 

			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->string('history');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *date('F d, Y') date('h:i A')
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audits');
	}

}
