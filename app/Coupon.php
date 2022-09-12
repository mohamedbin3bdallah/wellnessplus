<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
	protected $table = 'coupons';

    protected $fillable = [
      'name', 'description', 'from', 'status','limitationForSingleUser', 'code','distype','amount','link_by','maxusage','minamount','expirydate','course_id', 'category_id','created_by', 'updated_by'
    ];

    public function cate (){
     	return $this->belongsTo("App\Categories","category_id");
    }

    public function product (){
     	return $this->belongsTo("App\Course","course_id");
    }
    public function creator(){
        return $this->belongsTo('App\User','created_by','id');
    }

    public function updater(){
        return $this->belongsTo('App\User','updated_by','id');
    }
}
