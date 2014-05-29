<?php

class Booth extends \Eloquent {

	protected $table =  'booths';
	protected $primarykey = 'id';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}