<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger_thread extends Model
{
    protected $fillable = ['subject'];
	
	public function message()
    {
		return $this->hasOne('App\Messenger_message','thread_id', 'id');
    }

}
