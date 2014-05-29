<?php

class BindingMethod extends Eloquent
{
    protected $guarded = [];
    protected $primarykey = 'id';
    protected $table = 'binding_methods';

    public static $rules = [
        'name' => 'required',
    ];
    public function template()
    {
        return $this->belongsTo('Template', 'id');
    }
}
