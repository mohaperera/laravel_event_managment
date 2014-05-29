<?php

class Managers extends Eloquent{

	protected $guarded = array();

	private $rules = array(
		'username'     => 'required|min:5',
        'password'     => 'required|min:5',
        'email'         => 'required|email',
    );

    private $errors;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

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

 	public function events()
    {
        return $this->hasMany('Events');
    }
    //===============================================
	
}