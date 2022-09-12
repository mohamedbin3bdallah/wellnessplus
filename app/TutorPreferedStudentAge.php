<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorPreferedStudentAge extends Model
{
    protected $table = 'tutor_prefered_student_ages';

    protected $fillable = ['tutor_id', 'prefered_student_age_id', 'created_by', 'updated_by'];
	
	/**
	* Relationship with tutor
	**/
    public function tutor()
    {
        return $this->belongsTo('App\Instructor','tutor_id','id');
    }
	
	/**
	* Relationship with prefered student age
	**/
    public function prefered_student_age()
    {
        return $this->belongsTo('App\PreferredStudentAge','prefered_student_age_id','id');
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
