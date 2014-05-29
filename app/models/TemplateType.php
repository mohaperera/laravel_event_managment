<?php

class TemplateType extends Eloquent
{
    protected $guarded = [];

    protected $table = 'template_types';
    protected $primarykey = 'id';

    public static $rules = [
        'name' => 'required',
    ];

    public function template()
    {
        return $this->belongsTo('Template', 'id');
    }
}
