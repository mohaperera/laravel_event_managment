<?php

class Eventmanager extends \Eloquent {

  	protected $guarded = [];
    protected $primarykey = 'id';
    protected $table = 'events';


    public static $rules = [];

  	protected $fillable = [];
  	
  	public function speaker()
    {
        return $this->belongsTo('Speaker', 'id');
    }	
}
