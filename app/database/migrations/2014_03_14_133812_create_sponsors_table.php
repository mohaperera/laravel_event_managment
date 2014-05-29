<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSponsorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sponsors', function(Blueprint $table) {
			$table->increments('id');
			$table->string('companyName');
			$table->string('company_path');
			$table->string('compnayLogo');
			$table->string('boothNumber');
			$table->string('sponsorshipcategory');
			$table->string('category');
			$table->string('website');
			$table->string('productsName');
			$table->string('image_path');
			$table->string('image');
			$table->string('productDescription');
			
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
		Schema::drop('sponsors');
	}

}
