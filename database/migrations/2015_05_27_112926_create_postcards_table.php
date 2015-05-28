<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postcards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('ownuser');
			$table->string('getuser');
			$table->string('path');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('postcards');
	}

}
