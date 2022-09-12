<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorPackage extends Model
{
    protected $table = 'tutor_packages';

    protected $fillable = ['tutor_id', 'name', 'title', 'about', 'description', 'numOfHours', 'origenalPrice', 'discountPrice', 'pricePerHour', 'totalPrice', 'status', 'featured', 'created_by', 'updated_by'];
	
	/**
	* Relationship with tutor
	**/
    public function tutor()
    {
        return $this->belongsTo('App\Instructor','tutor_id','id');
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
