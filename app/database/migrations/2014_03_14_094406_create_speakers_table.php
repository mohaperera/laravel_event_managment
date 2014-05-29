<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpeakersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('speakers', function(Blueprint $table) {
			$table->increments('id');
			
			$table->integer('event_id')->unsigned()->index();
            $table->foreign('event_id')->references('id')->on('events');
	
			$table->string('SpeakerName')->unique();
			$table->string('jobTitle');
			$table->string('companyName');
			$table->string('sessionTitle');

			$table->string('facebookAccount');
			$table->string('twitterAccount');
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
		Schema::drop('speakers');
	}

}
