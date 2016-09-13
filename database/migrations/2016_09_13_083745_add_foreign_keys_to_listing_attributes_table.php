<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToListingAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listing_attributes', function(Blueprint $table)
		{
			$table->foreign('listing_id', 'listing_attributes_ibfk_1')->references('id')->on('listings')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('attribute_id', 'listing_attributes_ibfk_2')->references('id')->on('attributes')->onUpdate('CASCADE')->onDelete('NO ACTION');
			$table->foreign('category_id', 'listing_attributes_ibfk_3')->references('id')->on('bussiness_categories')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('listing_attributes', function(Blueprint $table)
		{
			$table->dropForeign('listing_attributes_ibfk_1');
			$table->dropForeign('listing_attributes_ibfk_2');
			$table->dropForeign('listing_attributes_ibfk_3');
		});
	}

}
