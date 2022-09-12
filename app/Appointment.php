<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Appointment extends Model
{
	use HasTranslations;

//    public $translatable = ['title', 'detail'];
    public $translatable = [];
    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
      $attributes = parent::toArray();

      foreach ($this->getTranslatableAttributes() as $name) {
          $attributes[$name] = $this->getTranslation($name, app()->getLocale());
      }

      return $attributes;
    }

    protected $fillable = ['user_id', 'instructor_id', 'date','course_id', 'title', 'detail', 'start_time', 'request', 'accept', 'files', 'status_id'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function courses()
    {
    	return $this->belongsTo('App\Course','course_id','id');
    }

    public function instructor()
    {
      return $this->belongsTo('App\Instructor','instructor_id','id')->with('user');
    }

    public function payment_transaction()
    {
        return $this->belongsTo('App\Payment_transaction','payment_transaction_id','id');
    }

    public function meeting()
    {
        return $this->hasOne('App\BBL','appointment_id','id');
    }
    public function review()
    {
        return $this->hasOne('App\ReviewRating','course_id', 'id');
    }
	
	public function cart()
    {
        return $this->hasOne('App\Cart','appointment_id','id');
    }
	
	public function student_coupon()
    {
        return $this->hasOne('App\StudentCoupon','appointment_id','id');
    }
}
