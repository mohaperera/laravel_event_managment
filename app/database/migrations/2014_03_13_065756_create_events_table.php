<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('events', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
			$table->string('title');
			$table->text('description');
			$table->string('start_date');
			$table->string('finish_date');
			$table->string('city');
			$table->string('image_path');
			$table->string('image');
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
	    Schema::drop('events');
	}

}

