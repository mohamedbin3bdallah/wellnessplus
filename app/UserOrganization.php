<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrganization extends Model
{
    protected $table = 'user_organization';

    protected $fillable = ['user_id', 'organization_id', 'created_by', 'updated_by'];

	/**
	* Relationship with user
	**/
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
	
	/**
	* Relationship with organization
	**/
	public function organization()
    {
        return $this->belongsTo('App\Organization','organization_id','id');
    }
	
	/**
	* Relationship with admin user who add student to partner
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
