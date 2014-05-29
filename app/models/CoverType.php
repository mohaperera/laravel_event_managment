<?php

class CoverType extends Eloquent
{
    protected $guarded = [];

    protected $primarykey = 'id';
    protected $table = 'cover_types';

    public static $rules = [
        'name' => 'required',
    ];

    public function template()
    {
        return $this->belongsTo('Template', 'id');
    }
}
