<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorCommissionLog extends Model
{
    protected $table = 'tutor_commissions_log';

    protected $fillable = ['user_id', 'tutor_id', 'appointment_id', 'action', 'value', 'created_by', 'updated_by'];

	/**
	* Relationship with user
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
	* Relationship with appointment
	**/
    public function appointment()
    {
        return $this->belongsTo('App\Appointment','appointment_id','id');
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
