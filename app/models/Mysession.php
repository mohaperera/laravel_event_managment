<?php

class Mysession extends \Eloquent {

	
	protected $table = 'mysessions';
	protected $primarykey = 'id';
	
	protected $guarded = array();

	private $rules = array(
		'session_title'     => 'required',
        'description'     => 'required',
        'room'     => 'required',
    );

    private $errors;


	// // Add your validation rules here
	// public static $rules = [
	// 	// 'title' => 'required'
	// ];

	// Don't forget to fill this array
	protected $fillable = [];

	public function validate($data)
    {
    	
    	$availableRule = array();
    	foreach($this->rules as $field => $rules) {
    		if (isset($data[$field])) {
    			$availableRule[$field] = $rules;
    		}    	
    	}
        // make a new validator object
        $v = Validator::make($data, $availableRule);

        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }
    //===============================================

    public function errors()
    {
        return $this->errors;
    }
	//===============================================


}