<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
	protected $table = 'instructors';

    protected $fillable = [ 'user_id', 'headline', 'detail', 'specialty', 'preferedStudentLevel','PreferredStudentAge', 'file', 'status', 'recommendation', 'PricePerHour', 'viewed', 'video','active_students','social_links','sanatorium','work_sanatorium','hospital','work_hospital','center','work_center'];

    public function courses()
    {
        return $this->hasMany('App\Course','user_id');

    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function languages()
    {
        return $this->hasMany('App\UserLanguages','user_id','user_id')->with('language', 'level');

    }
    public function schedule()
    {
        return $this->hasMany('App\TutorScheduleTimeBlocks','user_id','user_id')->with('zone');

    }
    public function favourite()
    {
        return $this->hasMany('App\Favourites','instructor_id','id');

    }
    public function bookedSlots()
    {
        return $this->hasMany('App\Appointment','instructor_id','id')->where('status_id','!=', 4);

    }
    public function reviews()
    {
        return $this->hasMany('App\ReviewRating','tutor_id','id');

    }
	public function tutor()
    {
        return $this->hasMany('App\PartnerTutor','tutor_id','id');
    }
	
	public function prefered_student_age()
    {
        return $this->hasMany('App\TutorPreferedStudentAge','tutor_id','id');
    }
	
	public function prefered_student_level()
    {
        return $this->hasMany('App\TutorPreferedStudentLevel','tutor_id','id');
    }
	
	public function appointment()
    {
        return $this->hasMany('App\Appointment','instructor_id');
    }
	
	public function meeting()
    {
        return $this->hasMany('App\BBL','instructor_id');
    }
	
	public function studentpackage()
    {
        return $this->hasMany('App\Student_package','tutor_id');
    }
	
	public function tutor_country_price_per_hour()
	{
		return $this->hasMany('App\TutorCountryPricePerHour','tutor_id');
	}
	
	public function tutor_specialty()
    {
        return $this->belongsTo('App\Specialties','specialty','id');
    }
	
	public function education()
    {
        return $this->hasMany('App\tutorEducation','tutor_id');
    }
	
	public function certificate()
    {
        return $this->hasMany('App\tutorCertificate','tutor_id');
    }
	
	public function work_experience()
    {
        return $this->hasMany('App\tutorWorkExperience','tutor_id');
    }
}
