<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tutorWorkExperience extends Model
{
    protected $table = 'tutor_work_experience';

    protected $fillable = ['tutor_id', 'company', 'title', 'file', 'from', 'to'];
}
