<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_notification_setting extends Model
{
    protected $fillable = ['user_id', 'type_id'];
}
