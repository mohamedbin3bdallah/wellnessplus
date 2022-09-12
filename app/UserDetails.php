<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'user_details';

    protected $fillable = ['user_id', 'national_id_name', 'national_id_image', 'work_other_platform', 'hear_about', 'created_by', 'updated_by'];
	
	/**
	* Relationship with user
	**/
    public function tutor()
    {
        return $this->belongsTo('App\User','user_id','id');
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
