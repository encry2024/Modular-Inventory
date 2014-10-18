<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntermediateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// CREATE INTERMEDIATE TABLE
		Schema::create('device_location', function($table) { 

			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('location_id')->unasigned();
			$table->integer('device_id')->unasigned();
			$table->integer('item_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('device_location');
	}

}
