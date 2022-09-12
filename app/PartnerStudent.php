<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerStudent extends Model
{
    protected $table = 'partner_students';

    protected $fillable = ['partner_id', 'student_id', 'created_by', 'updated_by'];

	/**
	* Relationship with partner user role
	**/
    public function partner()
    {
        return $this->belongsTo('App\User','partner_id','id');
    }
	
	/**
	* Relationship with tutor
	**/
	public function student()
    {
        return $this->belongsTo('App\User','student_id','id');
    }
	
	/**
	* Relationship with user organization
	**/
	public function user_organization()
    {
        return $this->belongsTo('App\UserOrganization','partner_id','user_id');
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
