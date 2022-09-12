<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCoupon extends Model
{
    protected $table = 'student_coupons';

    protected $fillable = ['user_id', 'coupon_id', 'appointment_id', 'done', 'created_by', 'updated_by'];
	
	/**
	* Relationship with student
	**/
	public function student()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
	
	/**
	* Relationship with coupon
	**/
	public function coupon()
    {
        return $this->belongsTo('App\Coupon','coupon_id','id');
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
