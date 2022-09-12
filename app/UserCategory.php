<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    protected $table = 'user_categories';

    protected $fillable = ['user_id', 'subcategory_id', 'created_by', 'updated_by'];
	
	/**
	* Relationship with user
	**/
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
	
	/**
	* Relationship with Subcategory
	**/
    public function subcategory()
    {
        return $this->belongsTo('App\SubCategory','subcategory_id','id');
    }
	
	/**
	* Relationship with admin user who add the record
	**/
	public function createdby()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
	
	/**
	* Relationship with admin user who update the record
	**/
	public function updatedby()
    {
        return $this->belongsTo('App\User','updated_by','id');
    }
}
