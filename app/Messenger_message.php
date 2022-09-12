<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messenger_message extends Model
{
    protected $fillable = ['thread_id', 'user_id', 'body','sender_id'];

    public function user()
    {
        return $this->hasOne('App\User','id', 'sender_id');
    }
	
	public function thread()
    {
		return $this->belongsTo('App\Messenger_thread','thread_id', 'id');
    }
	
	public function sender()
    {
		return $this->belongsTo('App\User','sender_id', 'id');
    }
	
	public function receiver()
    {
		return $this->belongsTo('App\User','user_id', 'id');
    }

}
