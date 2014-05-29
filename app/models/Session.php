<?php

class Session extends \Eloquent {

	protected $table = 'sessions';
	protected $primarykey = 'id';


	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

}