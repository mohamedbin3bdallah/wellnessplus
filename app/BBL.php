<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BBL extends Model
{
    protected $table = 'bigbluemeetings';

    protected $fillable = ['meetingid','meetingname','modpw','attendeepw','welcomemsg','duration','setMaxParticipants','setMuteOnStart','allow_record','presen_name','instructor_id','detail','start_time', 'is_ended', 'link_by', 'course_id','appointment_id', 'status'];

    public function user(){
    	return $this->belongsTo('App\User','instructor_id','id');
    }

    public function course(){
    	return $this->belongsTo('App\Course','course_id','id');
    }

    public function tutor(){
        return $this->belongsTo('App\Instructor','instructor_id','id')->with('user');
    }
    public function appointment(){
        return $this->belongsTo('App\Appointment','appointment_id','id')->with('user');
    }
	public function partnertutor(){
        return $this->belongsTo('App\PartnerTutor','instructor_id','tutor_id');
    }
}
