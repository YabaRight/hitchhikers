<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('attributes', function(Blueprint $table)
		{
			$table->foreign('bussiness_category_id', 'attributes_ibfk_1')->references('id')->on('bussiness_categories')->onUpdate('CASCADE')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('attributes', function(Blueprint $table)
		{
			$table->dropForeign('attributes_ibfk_1');
		});
	}

}
