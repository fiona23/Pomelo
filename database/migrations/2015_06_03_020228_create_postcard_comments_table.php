<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcardCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('postcard_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('postcard_id');
			$table->string('content');
			$table->string('name');
			$table->string('nickname');
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
		Schema::drop('postcard_comments');
	}

}
