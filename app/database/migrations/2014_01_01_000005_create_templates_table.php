<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'templates',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('title');
                $table->string('alias')->unique();
                $table->text('design_data')->nullable();
                $table->string('exterior_dimensions')->nullable();
                $table->string('interior_dimensions')->nullable();
                $table->smallInteger('pages')->nullable();
                $table->smallInteger('symmetrical_bleed')->nullable();
                $table->smallInteger('spine_width')->nullable();
                $table->smallInteger('hinge_offset')->nullable();
                $table->boolean('collate')->nullable();
                $table->boolean('crop_marks')->nullable();
                $table->boolean('published')->nullable();
                $table->boolean('seam_orientation')->nullable();
                $table->string('state')->default('pending');

                $table->integer('template_type_id')->unsigned()->index();
                $table->foreign('template_type_id')->references('id')->on('template_types');

                $table->integer('binding_method_id')->unsigned()->index();
                $table->foreign('binding_method_id')->references('id')->on('binding_methods');

                $table->integer('cover_type_id')->unsigned()->index();
                $table->foreign('cover_type_id')->references('id')->on('cover_types');

                $table->integer('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users');

                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('templates');
    }
}
