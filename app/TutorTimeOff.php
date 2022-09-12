<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorTimeOff extends Model
{
    protected $table = 'tutor_time_off';

    protected $fillable = [ 'tutor_id', 'message', 'title', 'start_date', 'end_date','start_time', 'end_time'];
}
