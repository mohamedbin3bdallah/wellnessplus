<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorScheduleTimeBlocks extends Model
{
    protected $table = 'tutor_schedule_time_blocks';

    protected $fillable = ['user_id', 'day', 'start_time', 'end_time', 'zone'];

    public function zone()
    {
        return $this->hasOne('App\Time_zone','id','zone');
    }

}
