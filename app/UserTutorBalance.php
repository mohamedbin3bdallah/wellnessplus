<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTutorBalance extends Model
{
    protected $table = 'user_tutor_balance';

    protected $fillable = ['user_id', 'tutor_id', 'balance', 'created_by', 'updated_by'];

	/**
	* Relationship with partner user role
	**/
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
	
	/**
	* Relationship with tutor
	**/
	public function tutor()
    {
        return $this->belongsTo('App\Instructor','tutor_id','id');
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
