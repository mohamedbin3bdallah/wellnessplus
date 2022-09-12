<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferredStudentAge extends Model
{
	protected $table = 'prefered_student_age';

    protected $fillable = [ 'age','created_by','updated_by'];
}
