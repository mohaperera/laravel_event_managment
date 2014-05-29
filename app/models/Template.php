<?php

class Template extends Eloquent
{
    protected $guarded = [];
    protected $primarykey = 'id';
    protected $table = 'templates';

    public static $rules = [
        'title' => 'required'
    ];

    /**
     *
     * @return hasOne Relationship with TemplateType Model
     */
    public function templateType()
    {
        return $this->hasOne('TemplateType', 'id');
    }

    /**
     *
     * @return hasOne Relationship with BindingMethod Model
     */

    public function bindingMethod()
    {
        return $this->hasOne('BindingMethod', 'id');
    }

    /**
     *
     * @return hasOne Relationship with CoverType Model
     */
    public function coverType()
    {
        return $this->hasOne('CoverType', 'id');
    }
    /**
     *
     * @return hasOne Relationship with USERS Model
     */
    public function user()
    {
        return $this->hasOne('User','id');
    }
    /**
     * Accessor for exterior_dimensions field
     */
    public function getExteriorDimensionsAttribute($value)
    {
        $result = unserialize($value);
        return [
            'width' => (int)$result['width'],
            'height' => (int)$result['height']
        ];
    }

    /**
     * Mutator for exterior_dimensions field
     */
    public function setExteriorDimensionsAttribute($value)
    {
        $this->attributes['exterior_dimensions'] = serialize($value);
    }

    /**
     * Accessor for interior_dimensions field
     */
    public function getInteriorDimensionsAttribute($value)
    {
        $result = unserialize($value);
        return [
            'width' => (int)$result['width'],
            'height' => (int)$result['height']
        ];
    }

    /**
     * Mutator for interior_dimensions field
     */
    public function setInteriorDimensionsAttribute($value)
    {
        $this->attributes['interior_dimensions'] = serialize($value);
    }

    /**
     * Accessor for cover_wrap_dimensions field
     */
    public function getCoverWrapDimensionsAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * Mutator for cover_wrap_dimensions field
     */
    public function setCoverWrapDimensionsAttribute($value)
    {
        $this->attributes['cover_wrap_dimensions'] = serialize($value);
    }

    /**
     * getThumbnailUrlAttribute
     */
    public function getThumbnailUrlAttribute()
    {
        $design_data = json_decode($this->attributes['design_data']);
        return is_null($design_data) ? "" : "/assets/{$this->alias}/thumbnail.jpg";
    }

    /**
     * toArray override
     */
    public function toArray()
    {
        $result = parent::toArray();
        $result['design_data'] = (array)json_decode($this->design_data);
        return $result;
    }
}
