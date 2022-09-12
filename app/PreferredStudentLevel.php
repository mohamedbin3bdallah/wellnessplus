<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreferredStudentLevel extends Model
{
	protected $table = 'prefered_student_level';

    protected $fillable = [ 'student_level','created_by','updated_by'];
}
