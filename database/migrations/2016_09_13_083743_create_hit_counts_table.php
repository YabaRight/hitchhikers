<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHitCountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hit_counts', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('listing_id')->index('business_id');
			$table->integer('hits')->index('hits');
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
		Schema::drop('hit_counts');
	}

}
