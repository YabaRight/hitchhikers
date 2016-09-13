<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateListingAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('listing_attributes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('listing_id')->index('listing_id');
			$table->integer('attribute_id')->index('category_id');
			$table->integer('category_id')->index('category_id_2');
			$table->string('value', 100);
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
		Schema::drop('listing_attributes');
	}

}
