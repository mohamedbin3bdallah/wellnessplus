<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $table = 'organizations';

    protected $fillable = ['name', 'commission', 'active', 'created_by', 'updated_by'];

	/**
	* Relationship with partner user role
	**/
    public function user_organization()
    {
        return $this->hasMany('App\UserOrganization','organization_id');
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
