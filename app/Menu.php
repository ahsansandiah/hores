<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
    	'parent_id',
    	'name',
    	'slug',
    	'route',
    	'icon'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'parent_name'
    ];

    // get parent name attribute
    public function getParentNameAttribute(){
    	$parent_id = $this->attributes['parent_id'];
    	if (!empty($parent_id)) {
    		$parent = Menu::where('id', $parent_id)->first();
    		if ($parent) {
    			return $parent->name;
    		}

    		return '';
    	}

    	return '';
    }
}
