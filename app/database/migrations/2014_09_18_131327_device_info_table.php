<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeviceInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('infos', function($table) { 

			$table->engine = 'InnoDB';

			$table->increments('id');
			$table->integer('device_id')->unsigned();
			$table->integer('field_id')->unsigned();
			$table->string('value');
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
		Schema::drop('infos');
	}

}
