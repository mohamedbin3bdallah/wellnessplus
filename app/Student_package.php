<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_package extends Model
{
	protected $fillable = ['paid'];
	
    public function package()
    {
        return $this->hasOne('App\Packages','id', 'package_id');
    }
}
