<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'email', 'password', 'lname', 'dob', 'time_zone_id', 'doa', 'mobile', 'address', 'city_id', 'visibility', 'archive',
        'state_id', 'country_id', 'country_residence_id', 'gender', 'pin_code', 'status', 'verified','facebook_id', 'google_id', 'role', 'married_status','user_img', 'detail', 'braintree_id', 'fb_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'email_verified_at','turor_order'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function country()
    {
      return $this->belongsTo('App\Allcountry','country_id', 'id');
    }
	
	public function country_residence()
    {
      return $this->belongsTo('App\Allcountry','country_residence_id', 'id');
    }

    public function state()
    {
      return $this->belongsTo('App\Allstate','state_id','id');
    }

    public function city()
    {
        return $this->belongsTo('App\Allcity','city_id','id');
    }
    public function courses()
    {
        return $this->hasMany('App\Course','user_id');

    }
    public function answer()
    {
        return $this->hasMany('App\Question','user_id');
    }

    public function announsment()
    {
        return $this->hasMany('App\Announcement','user_id');
    }

    public function review()
    {
        return $this->hasMany('App\ReviewRating','user_id');
    }

    public function reportreview()
    {
        return $this->hasMany('App\ReportReview','user_id');
    }

    public function viewprocess()
    {
        return $this->hasMany('App\ViewProcess','user_id');
    }

    public function wishlist()
    {
        return $this->hasMany('App\Wishlist','user_id');
    }

    public function blogs()
    {
        return $this->hasMany('App\Blog','user_id');
    }

    public function relatedcourse()
    {
        return $this->hasMany('App\RelatedCourse','user_id');
    }

    public function courseclass()
    {
        return $this->hasMany('App\CourseClass','user_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order','user_id');
    }

    public function pending()
    {
        return $this->hasMany('App\PendingPayout','user_id');
    }

    public function liveclass()
    {
        return $this->hasMany('App\LiveCourse','user_id');
    }

    public function completed()
    {
        return $this->hasMany('App\CompletedPayout','user_id');
    }

    public function bundle()
    {
        return $this->hasMany('App\BundleCourse','user_id');
    }

    public function timeZone()
    {
        return $this->hasOne('App\Time_zone','id', 'time_zone_id');

    }

    public function messages()
    {
        return $this->hasMany('App\Messenger_message','user_id')->orderBy('id', 'desc');

    }
    public function unReadMessages()
    {
        return $this->hasMany('App\Messenger_message','user_id')->where('is_read' , 0 )->orderBy('id', 'desc');

    }

    public function notifications()
    {
        return $this->hasMany('App\Notification','notifiable_id')->orderBy('id', 'desc');

    }

    public function instructor()
    {
        return $this->hasOne('App\Instructor', 'user_id');

    }
	
	public function partner()
    {
        return $this->hasMany('App\PartnerStudent','partner_id');
    }
	
	public function student()
    {
        return $this->hasMany('App\PartnerStudent','student_id');
    }
	
	public function studentpackage()
    {
        return $this->hasMany('App\Student_package','user_id');
    }
	
	public function userorganization()
    {
        return $this->hasOne('App\UserOrganization','user_id');
    }
	
	public function appointment()
    {
        return $this->hasMany('App\Appointment','user_id');
    }
	
	public function favourite()
    {
        return $this->hasMany('App\Favourites','user_id');
    }
	
	public function messages_sender()
    {
        return $this->hasMany('App\Messenger_message','sender_id');
    }
	
	public function coupon()
    {
        return $this->hasMany('App\StudentCoupon','user_id');
    }
	
	public function category()
    {
        return $this->hasMany('App\UserCategory','user_id');
    }
	
	public function user_details()
    {
        return $this->hasOne('App\UserDetails','user_id');
    }
	
	public function scopeNotVerified($query)
	{
		return $query->whereNull('email_verified_at');
	}

//    public function language()
//    {
//        return $this->hasMany('App\UserLanguages','user_id');
//
//    }
}

