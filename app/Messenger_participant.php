<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger_participant extends Model
{
    protected $fillable = ['thread_id', 'user_id', 'last_read'];

}
