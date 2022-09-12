<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorCountryPricePerHour extends Model
{
    protected $table = 'tutor_country_prices_per_hour';

    protected $fillable = ['tutor_id', 'country_id', 'pricePerHour', 'currency', 'status', 'created_by', 'updated_by'];
	
	/**
	* Relationship with tutor
	**/
    public function tutor()
    {
        return $this->belongsTo('App\Instructor','tutor_id','id');
    }
	
	/**
	* Relationship with country
	**/
    public function country()
    {
        return $this->belongsTo('App\Allcountry','country_id','id');
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
