<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExhibitorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exhibitors', function(Blueprint $table) {
			$table->increments('id');
			$table->string('companyName');
			$table->string('compnayLogo');
			$table->string('boothNumber');
			$table->string('category');
			$table->string('website');
			$table->string('productsName');
			$table->string('image');
			$table->string('productDescription');
			$table->string('featured');
			
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
		Schema::drop('exhibitors');
	}

}
