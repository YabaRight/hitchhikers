<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100);
			$table->text('description', 65535);
			$table->string('address', 100);
			$table->text('phone', 65535);
			$table->string('x_coordinate', 50);
			$table->string('y_coordinate', 50);
			$table->string('email', 200);
			$table->string('twitter', 100);
			$table->string('facebook', 100);
			$table->string('instagram', 100);
			$table->string('hours', 100);
			$table->string('url', 100);
			$table->string('verified', 6)->default("false");
			$table->string('has_attributes', 6);
			$table->text('image', 65535);
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
		Schema::drop('listings');
	}

}
