<?php

class Exhibitor extends \Eloquent {

	protected $table = 'exhibitors';
	protected $primarykey = 'id';
	
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}