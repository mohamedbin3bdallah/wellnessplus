<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tutorNotificationSettings extends Model
{
    protected $table = 'tutor_notification_settings';

    protected $fillable = ['user_id', 'type_id'];
}
