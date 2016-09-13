<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToHitCountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('hit_counts', function(Blueprint $table)
		{
			$table->foreign('listing_id', 'hit_counts_ibfk_1')->references('id')->on('listings')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('hit_counts', function(Blueprint $table)
		{
			$table->dropForeign('hit_counts_ibfk_1');
		});
	}

}
