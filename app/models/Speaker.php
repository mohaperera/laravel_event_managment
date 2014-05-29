<?php

class Speaker extends \Eloquent {

	protected $table = 'speakers';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = [];

	public function eventName()
    {
        return $this->hasOne('Eventmanager', 'id');
    }




}